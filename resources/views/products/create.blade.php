{{-- resources/views/products/create.blade.php --}}
<x-app-layout>
    <div class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <div class="mb-8">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('products.index') }}" class="text-orange-600 hover:text-orange-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Add New Product</h1>
                        <p class="text-gray-600 mt-2">Create a new food item for your restaurant</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                       placeholder="e.g., Beef Burger Deluxe">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (Rp) *</label>
                                <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" step="any"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                       placeholder="e.g., 50000">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                                <textarea id="description" name="description" rows="4" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                          placeholder="e.g., Juicy beef patty with fresh lettuce, tomato, and our special sauce.">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                                <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100"
                                       onchange="previewImage(event)">
                                <img id="imagePreview" src="#" alt="Image Preview" class="mt-4 rounded-lg shadow-sm max-h-48 w-auto" style="display:none;"/>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                                @error('is_featured')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="{{ route('products.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg transition-colors duration-200 shadow-sm">
                            Cancel
                        </a>
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 shadow-md">
                            <svg class="h-5 w-5 inline-block mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>