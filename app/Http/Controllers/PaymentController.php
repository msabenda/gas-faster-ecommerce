<?php
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Process PayPal checkout
     */
    public function checkout(Request $request)
    {
        try {
            $user = Auth::guard('web')->user();
            $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

            // Validate cart contents
            if ($cartItems->isEmpty()) {
                Log::warning('Checkout attempted with empty cart', ['user_id' => $user->id]);
                return response()->json(['error' => 'Your cart is empty.'], 400);
            }

            // Validate product prices
            foreach ($cartItems as $item) {
                if (!$item->product || $item->product->price <= 0) {
                    Log::error('Invalid product price in cart', [
                        'product_id' => $item->product_id, 
                        'price' => $item->product ? $item->product->price : null
                    ]);
                    return response()->json(['error' => 'Invalid product price in cart.'], 400);
                }
            }

            // Initialize PayPal client
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $accessToken = $provider->getAccessToken();

            // Calculate amounts with precise rounding
            $exchangeRate = config('paypal.exchange_rate_tzs_to_usd', 2700);
            $currency = config('paypal.currency', 'USD');

            // Calculate item totals
            $itemTotalUsd = 0;
            $items = $cartItems->map(function ($item) use ($exchangeRate, &$itemTotalUsd) {
                $unitPriceUsd = round($item->product->price / $exchangeRate, 2);
                $itemTotal = round($unitPriceUsd * $item->quantity, 2);
                $itemTotalUsd += $itemTotal;

                return [
                    'name' => substr($item->product->name, 0, 127),
                    'quantity' => $item->quantity,
                    'unit_amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => number_format($unitPriceUsd, 2, '.', ''),
                    ],
                ];
            })->toArray();

            $totalTzs = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $totalUsd = round($totalTzs / $exchangeRate, 2);

            // Verify amounts match within acceptable tolerance
            if (abs($itemTotalUsd - $totalUsd) > 0.01) {
                Log::error('Amount mismatch detected', [
                    'item_total_usd' => $itemTotalUsd,
                    'total_usd' => $totalUsd,
                    'difference' => abs($itemTotalUsd - $totalUsd)
                ]);
                return response()->json(['error' => 'Payment calculation error. Please try again.'], 500);
            }

            // Prepare order data
            $orderReference = 'GASFASTER_' . Str::random(16);

            $orderData = [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'reference_id' => $orderReference,
                        'description' => 'Order from GasFaster',
                        'amount' => [
                            'currency_code' => $currency,
                            'value' => number_format($totalUsd, 2, '.', ''),
                            'breakdown' => [
                                'item_total' => [
                                    'currency_code' => $currency,
                                    'value' => number_format($itemTotalUsd, 2, '.', ''),
                                ],
                            ],
                        ],
                        'items' => $items,
                    ],
                ],
                'application_context' => [
                    'cancel_url' => route('paypal.cancel'),
                    'return_url' => route('paypal.success', ['order_reference' => $orderReference]),
                ],
            ];

            // Create PayPal order
            $order = $provider->createOrder($orderData);
            Log::info('PayPal Create Order Response', ['order' => $order]);

            if (isset($order['id'])) {
                foreach ($order['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return response()->json(['checkout_url' => $link['href']]);
                    }
                }
                Log::error('No approve link in PayPal response', ['order' => $order]);
                return response()->json(['error' => 'Could not initiate PayPal checkout.'], 500);
            }

            Log::error('Failed to create PayPal order', ['order_response' => $order]);
            return response()->json(['error' => $order['error']['message'] ?? 'Failed to create PayPal order.'], 500);

        } catch (\Exception $e) {
            Log::error('PayPal Checkout Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'Checkout failed: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Handle successful PayPal payment
     */
    public function success(Request $request)
    {
        try {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            
            $response = $provider->capturePaymentOrder($request->token);
            Log::info('PayPal Capture Response', ['response' => $response]);

            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                $user = Auth::guard('web')->user();
                $capture = $response['purchase_units'][0]['payments']['captures'][0];
                
                $amountUsd = $capture['amount']['value'];
                $exchangeRate = config('paypal.exchange_rate_tzs_to_usd', 2700);
                $amountTzs = round($amountUsd * $exchangeRate, 2);

                // Create payment record
                Payment::create([
                    'transaction_id' => $response['id'],
                    'amount' => $amountUsd,
                    'amount_tzs' => $amountTzs,
                    'currency' => $capture['amount']['currency_code'],
                    'status' => $response['status'],
                    'user_id' => $user->id,
                    'order_reference' => $request->query('order_reference'),
                    'paypal_response' => json_encode($response),
                ]);

                // Clear the user's cart
                CartItem::where('user_id', $user->id)->delete();

                return redirect()->route('home')->with('success', 'Payment completed successfully!');
            }

            Log::error('PayPal payment not completed', ['response' => $response]);
            return redirect()->route('home')->with('error', 'Payment failed or was not completed.');

        } catch (\Exception $e) {
            Log::error('PayPal Success Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('home')
                ->with('error', 'Payment processing failed: ' . $e->getMessage());
        }
    }

    /**
     * Handle cancelled PayPal payment
     */
    public function cancel()
    {
        return redirect()->route('home')->with('error', 'Payment was cancelled.');
    }
}