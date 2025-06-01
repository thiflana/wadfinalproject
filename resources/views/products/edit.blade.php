{{-- resources/views/products/edit.blade.php --}}
<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Product</h1>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700 mb-1">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium text-gray-700 mb-1">Description</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block font-medium text-gray-700 mb-1">Price</label>
                <input type="number" id="price" name="price" min="0" step="0.01" value="{{ old('price', $product->price) }}" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />
            </div>

            <div class="mb-4">
                <label for="image" class="block font-medium text-gray-700 mb-1">Product Image</label>
                @if($product->image_path)
                    <img src="{{ Storage::url($product->image_path) }}" alt="Current Image" class="w-48 mb-2 rounded">
                @endif
                <input type="file" id="image" name="image" accept="image/*" class="block">
                <small class="text-gray-500">Leave blank to keep current image.</small>
            </div>

            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-6 rounded-md font-semibold">
                Update Product
            </button>

            <a href="{{ route('products.index') }}" class="ml-4 text-gray-600 underline">
                Cancel
            </a>
        </form>
    </div>
</x-app-layout>
