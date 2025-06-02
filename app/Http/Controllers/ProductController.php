<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Umkm; 

class ProductController extends Controller
{
    public function index()
    {
        $umkm_id = auth()->user()->umkm_id ?? null; // Ensure it doesn’t break
        $products = $umkm_id ? Product::where('umkm_id', $umkm_id)->paginate(10) : Product::paginate(10); // Fallback to all products
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }

   public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('products', 'public');
        }

        // Ensure the user has an UMKM, create one if missing
        $umkm = Umkm::firstOrCreate(
            ['user_id' => auth()->id()], // Check if the user already has an UMKM
            ['name' => 'Default UMKM'] // Create a new UMKM with default name if needed
        );

        // Assign the UMKM ID dynamically
        $validated['umkms_id'] = $umkm->id;

        // Create the product
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        // Check if user owns this product
        if ($product->umkm_id !== Auth::user()->umkm_id) {
            abort(403);
        }

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Check if user owns this product
        if ($product->umkm_id !== Auth::user()->umkm_id) {
            abort(403);
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Check if user owns this product
        if ($product->umkm_id !== Auth::user()->umkm_id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old imageW
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $imagePath;
        }

        $product->update($validated);

        return redirect()->route('products.index')
                        ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Check if user owns this product
        if ($product->umkm_id !== Auth::user()->umkm_id) {
            abort(403);
        }

        // Delete image if exists
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('products.index')
                        ->with('success', 'Product deleted successfully!');
    }

}