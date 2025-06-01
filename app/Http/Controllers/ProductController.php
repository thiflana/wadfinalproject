<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('umkm_id', 1)->paginate(10);
        
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
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'umkm_id' => 'required'
    ]);

        $products = Product::all();

        // Handle image upload
        if ($request->hasFile('image')) {
        $validated['image_path'] = $request->file('image')->store('products', 'public');
    }

        Product::create($validated);

        return redirect()->route('products.index')
                        ->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        // Check if user owns this product
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Check if user owns this product
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Check if user owns this product
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'umkm_id' => 'required'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
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
        if ($product->user_id !== Auth::id()) {
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

    public function toggleStatus(Product $product)
    {
        // Check if user owns this product
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $product->update(['is_active' => !$product->is_active]);

        $status = $product->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()
                        ->with('success', "Product {$status} successfully!");
    }
}