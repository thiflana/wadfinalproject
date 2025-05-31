<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Display all wishlist items for the authenticated user
    public function index()
    {
        // Fetch wishlist items with product details
        $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->get();

        // Return the Blade template with wishlist data
        return view('wishlist', compact('wishlists'));
    }

    // Add a product to the wishlist
    public function store(Request $request)
    {
        // Validate that product_id is provided and exists in the database
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Check if the product is already in the wishlist
        $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $request->product_id)->exists();
        if ($exists) {
            return redirect()->back()->with('message', 'Product is already in your wishlist!');
        }

        // Add product to wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('message', 'Product added to wishlist!');
    }

    // Remove a product from the wishlist
    public function destroy($id)
    {
        // Find the wishlist entry for the authenticated user
        $wishlist = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();

        // If the item doesn't exist, return an error response
        if (!$wishlist) {
            return redirect()->back()->with('message', 'Product not found in wishlist!');
        }

        // Delete the wishlist entry
        $wishlist->delete();

        // Redirect back with success message
        return redirect()->back()->with('message', 'Product removed from wishlist!');
    }
}