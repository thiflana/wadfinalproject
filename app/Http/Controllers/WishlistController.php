<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Toggle wishlist status for a product
     */
    public function toggle(Request $request, Product $product)
    {
    if (!Auth::check()) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to wishlist products'
            ], 401);
        } else {
            return redirect()->route('login');
        }
    }

    $user = Auth::user();
    $wishlist = Wishlist::where('user_id', $user->id)
        ->where('product_id', $product->id)
        ->first();

    if ($wishlist) {
        $wishlist->delete();
        $isWishlisted = false;
        $message = 'Removed from wishlist';
    } else {
        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
        $isWishlisted = true;
        $message = 'Added to wishlist';
    }

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'is_wishlisted' => $isWishlisted,
            'message' => $message
        ]);
    }

    return redirect()->back()->with('success', $message);
}

    /**
     * Get user's wishlist
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $wishlist = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->paginate(12);

        return view('wishlist.index', compact('wishlist'));
    }

    /**
     * Check if product is wishlisted by current user
     */
    public function check(Product $product)
    {
        if (!Auth::check()) {
            return response()->json(['is_wishlisted' => false]);
        }

        $isWishlisted = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->exists();

        return response()->json(['is_wishlisted' => $isWishlisted]);
    }
    
    public function updateNotes(Request $request, $wishlistId)
    {
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'You must be logged in'
        ], 401);
    }

    $request->validate([
        'notes' => 'nullable|string|max:255'
    ]);

    $wishlist = Wishlist::where('id', $wishlistId)
        ->where('user_id', Auth::id())
        ->first();

    if (!$wishlist) {
        return response()->json([
            'success' => false,
            'message' => 'Wishlist item not found'
        ], 404);
    }

    $wishlist->update([
        'notes' => $request->notes
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Notes updated successfully'
    ]);
    }
}