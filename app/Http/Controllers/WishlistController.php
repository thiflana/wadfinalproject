<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Display all wishlists for the logged-in user
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())
            ->with('product')
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    // Store a new wishlist entry
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        // Prevent duplicate wishlists
        $existing = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Product already in wishlist.');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    // Update wishlist notes
    public function update(Request $request, Wishlist $wishlist)
    {
        $request->validate([
            'notes' => 'nullable|string'
        ]);

        // Check ownership
        if ($wishlist->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $wishlist->update([
            'notes' => $request->notes
        ]);

        return redirect()->back()->with('success', 'Wishlist updated!');
    }

    // Delete wishlist entry
    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $wishlist->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }
}
