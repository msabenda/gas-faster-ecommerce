<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function checkout(Request $request)
    {
        $user = Auth::guard('web')->user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty.'], 400);
        }

        $orderReference = 'GASFASTER_' . Str::random(16);
        $merchantId = env('CLICKPESA_MERCHANT_ID', 'your-merchant-id'); // Set in .env
        $apiUrl = env('CLICKPESA_API_URL', 'https://sandbox.clickpesa.com/webshop/generate-checkout-url');

        $orderItems = $cartItems->map(function ($item) {
            return [
                'name' => $item->product->name,
                'product_type' => 'PRODUCT',
                'unit' => '1 pc(s)',
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ];
        })->toArray();

        $payload = [
            'orderItems' => $orderItems,
            'orderReference' => $orderReference,
            'merchantId' => $merchantId,
            // 'callbackURL' => env('CLICKPESA_CALLBACK_URL'), // Optional, uncomment if used
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($apiUrl, $payload);

            if ($response->successful()) {
                $checkoutUrl = $response->json();
                // Optionally store order in database
                return response()->json(['checkout_url' => $checkoutUrl]);
            }

            return response()->json(['error' => 'Failed to generate checkout URL.'], 500);
        } catch (\Exception $e) {
            \Log::error('ClickPesa checkout error: ' . $e->getMessage());
            return response()->json(['error' => 'Checkout error. Please try again.'], 500);
        }
    }
}