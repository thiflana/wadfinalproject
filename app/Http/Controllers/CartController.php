<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cart()->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->subtotal);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
            'notes' => 'nullable|string|max:255'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
                'notes' => $request->notes ?? $cartItem->notes
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'notes' => $request->notes
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => Auth::user()->cart_count,
            'total' => Auth::user()->cart_total
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        $this->authorize('update', $cart);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'subtotal' => $cart->subtotal,
            'total' => Auth::user()->cart_total
        ]);
    }

    public function remove(Cart $cart)
    {
    if ($cart->user_id !== auth()->id()) {
        abort(403);
    }

    $cart->delete();

    return response()->json([
        'success' => true,
        'message' => 'Item removed from cart',
    ]);
    }       

// Clear all cart items
public function clear()
    {
    auth()->user()->carts()->delete();

    return response()->json([
        'success' => true,
        'message' => 'All cart items cleared',
    ]);
    }
}
