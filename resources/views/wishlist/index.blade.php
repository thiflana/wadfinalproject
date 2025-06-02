{{-- resources/views/wishlist/index.blade.php --}}
<x-app-layout>
    <div class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">My Wishlist</h1>
                    <p class="text-gray-600 mt-2">Here are the products you have added to your wishlist.</p>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Wishlist Grid -->
            @if($wishlist->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($wishlist as $item)
                        @php $product = $item->product; @endphp
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <!-- Product Image -->
                            <div class="relative">
                                @if($product->image_path)
                                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="h-48 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center">
                                        <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                        {{ $product->price }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $product->restaurant_name }}</p>
                                <p class="text-gray-500 text-xs mb-3 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>

                                <div class="flex space-x-2">
                                    <a href="{{ route('products.show', $product) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                        View
                                    </a>

                                    <!-- Remove from Wishlist -->
                                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $wishlist->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No wishlist items</h3>
                    <p class="mt-2 text-gray-500">Browse the menu and add items you like.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 shadow-md">
                            Browse Products
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
