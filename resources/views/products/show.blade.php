{{-- resources/views/products/show.blade.php --}}
<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>

        @if($product->image_path)
            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full max-h-96 object-cover rounded-lg mb-6" />
        @endif

        <p class="text-gray-700 mb-4">{{ $product->description }}</p>

        <p class="text-xl font-semibold mb-2">Price: <span class="text-orange-600">{{ $product->price }}</span></p>
        
        <a href="{{ route('products.edit', $product) }}" class="inline-block bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-md mr-2">
            Edit
        </a>

        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">
                Delete
            </button>
        </form>

        <a href="{{ route('products.index') }}" class="inline-block ml-4 text-gray-600 underline">
            Back to Products
        </a>
    </div>
</x-app-layout>
