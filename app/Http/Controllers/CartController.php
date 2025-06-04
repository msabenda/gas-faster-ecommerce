<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $userId = Auth::user()->id;
        $productId = $request->product_id;

        $cartItem = CartItem::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return response()->json(['message' => 'Product added to cart!']);
    }

    /**
     * Remove a product from the cart.
     */
    public function remove($id)
    {
        $cartItem = CartItem::where('user_id', Auth::user()->id)->where('id', $id)->firstOrFail();
        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart!']);
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:cart_items,id'],
            'action' => ['required', 'in:increment,decrement'],
        ]);

        $cartItem = CartItem::where('user_id', Auth::user()->id)->where('id', $request->id)->firstOrFail();

        if ($request->action === 'increment') {
            $cartItem->increment('quantity');
        } elseif ($request->action === 'decrement' && $cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } elseif ($request->action === 'decrement' && $cartItem->quantity === 1) {
            $cartItem->delete();
        }

        return response()->json(['message' => 'Cart updated!']);
    }

    /**
     * Get cart item count.
     */
    public function count()
    {
        $count = CartItem::where('user_id', Auth::user()->id)->sum('quantity');
        return response()->json(['count' => $count]);
    }
}