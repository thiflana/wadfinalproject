{{-- resources/views/products/index.blade.php --}}
<x-app-layout>
    <!-- Main Content -->
    <div class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">My Product Listings</h1>
                    <p class="text-gray-600 mt-2">Manage your restaurant products and menu items</p>
                </div>
                <a href="{{ route('products.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 shadow-md">
                    <svg class="h-5 w-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Product
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
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
                                    <!-- Favorite Button (Top Left) -->
                                    <div class="absolute top-3 left-3">
                                        <button type="button" 
                                                class="favorite-btn bg-white/90 hover:bg-white p-2 rounded-full shadow-md transition-all duration-200 group" 
                                                data-product-id="{{ $product->id }}"
                                                data-favorited="{{ auth()->check() && auth()->user()->Wishlist()->where('product_id', $product->id)->exists() ? 'true' : 'false' }}">
                                            <!-- Heart icon (filled when favorited, outlined when not) -->
                                            <svg class="h-5 w-5 transition-all duration-200 heart-icon" 
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" 
                                                    stroke-linejoin="round" 
                                                    stroke-width="2" 
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>     
                                <!-- Price -->
                                <div class="absolute top-3 right-3">
                                    <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold">{{ $product->price }}</span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $product->restaurant_name }}</p>
                                <p class="text-gray-500 text-xs mb-3 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>

                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('products.show', $product) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                        View
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-center py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                        Edit
                                    </a>                                    
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                
                                <!-- Toggle Status -->
                                <form action="{{ route('products.toggle-status', $product) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('PATCH')
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No products yet</h3>
                    <p class="mt-2 text-gray-500">Get started by creating your first product listing.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 shadow-md">
                            Add Your First Product
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all favorite buttons
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    
    favoriteButtons.forEach(button => {
        updateHeartIcon(button);
        
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const productId = this.dataset.productId;
            const isCurrentlyFavorited = this.dataset.favorited === 'true';
            
            // Add loading state
            this.classList.add('opacity-50', 'pointer-events-none');
            
            try {
                const response = await fetch(`/wishlist/${productId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update the button state
                    this.dataset.favorited = data.is_wishlisted ? 'true' : 'false';
                    updateHeartIcon(this);
                    
                    // Show success message (optional)
                    showToast(data.message);
                } else {
                    if (response.status === 401) {
                        // Redirect to login or show login modal
                        showToast('Please log in to wishlist products');
                        // window.location.href = '/login';
                    } else {
                        showToast('Something went wrong. Please try again.');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.');
            } finally {
                // Remove loading state
                this.classList.remove('opacity-50', 'pointer-events-none');
            }
        });
    });
});

function updateHeartIcon(button) {
    const heartIcon = button.querySelector('.heart-icon');
    const isWishlisted = button.dataset.favorited === 'true';

    if (isWishlisted) {
        heartIcon.setAttribute('fill', 'currentColor'); // Fill heart
        heartIcon.setAttribute('stroke', 'currentColor');
        heartIcon.classList.remove('text-gray-600', 'group-hover:text-red-500');
        heartIcon.classList.add('text-red-500');
    } else {
        heartIcon.setAttribute('fill', 'none'); // Outline heart
        heartIcon.setAttribute('stroke', 'currentColor');
        heartIcon.classList.remove('text-red-500');
        heartIcon.classList.add('text-gray-600', 'group-hover:text-red-500');
    }
}

function showToast(message) {
    // Simple toast notification
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-all duration-300';
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.add('translate-x-0');
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">

</x-app-layout>