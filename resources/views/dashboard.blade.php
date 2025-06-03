{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <!-- Main Content -->
    <div class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="mb-8">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Welcome to Warungku</h1>
                    <p class="text-gray-600 text-lg">Discover delicious food from local restaurants</p>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-8">
                <div class="max-w-md mx-auto">
                    <div class="relative">
                        <input type="text" 
                               id="searchInput"
                               placeholder="Search for restaurants, cuisines, or dishes..." 
                               class="w-full px-4 py-3 pl-10 pr-4 border border-gray-200 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Products Section -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <svg class="h-6 w-6 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900">Available Products</h2>
                </div>
                
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="productsGrid">
                        @foreach($products as $product)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 product-card" 
                                 data-name="{{ strtolower($product->name) }}" 
                                 data-restaurant="{{ strtolower($product->umkm->name ?? 'Unknown Restaurant') }}"
                                 data-description="{{ strtolower($product->description ?? '') }}">
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
                                    @auth
                                        <div class="absolute top-3 left-3">
                                            <button type="button" 
                                                    class="favorite-btn bg-white/90 hover:bg-white p-2 rounded-full shadow-md transition-all duration-200 group" 
                                                    data-product-id="{{ $product->id }}"
                                                    data-favorited="{{ auth()->user()->Wishlist()->where('product_id', $product->id)->exists() ? 'true' : 'false' }}">
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
                                    @endauth
                                    
                                    <!-- Price -->
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="p-4">
                                    <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $product->name }}</h3>
                                    <p class="text-gray-600 text-sm mb-2">{{ $product->umkm->name ?? 'Unknown Restaurant' }}</p>
                                    <p class="text-gray-500 text-xs mb-3 line-clamp-2">{{ Str::limit($product->description, 60) }}</p>

                                    <!-- Action Buttons -->
                                    <div class="flex space-x-2">
                                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded-md text-sm font-medium transition-colors duration-200 view-product-btn" 
                                                data-product-id="{{ $product->id }}">
                                            View Details
                                        </button>
                                        @auth
                                            <button class="flex-1 bg-green-500 hover:bg-green-600 text-white text-center py-2 rounded-md text-sm font-medium transition-colors duration-200 order-btn" 
                                                    data-product-id="{{ $product->id }}">
                                                Order Now
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}" class="flex-1 bg-green-500 hover:bg-green-600 text-white text-center py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                                Login to Order
                                            </a>
                                        @endauth
                                    </div>
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
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No products available yet</h3>
                        <p class="mt-2 text-gray-500">Check back later for delicious food options!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Product Detail Modal -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full max-h-96 overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 id="modalTitle" class="text-xl font-bold text-gray-900"></h3>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="modalContent">
                        <!-- Content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const productCards = document.querySelectorAll('.product-card');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        productCards.forEach(card => {
            const name = card.dataset.name;
            const restaurant = card.dataset.restaurant;
            const description = card.dataset.description;
            
            if (name.includes(searchTerm) || restaurant.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

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
                    
                    // Show success message
                    showToast(data.message);
                } else {
                    if (response.status === 401) {
                        showToast('Please log in to wishlist products');
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

    // Product detail modal functionality
    const modal = document.getElementById('productModal');
    const closeModal = document.getElementById('closeModal');
    const viewButtons = document.querySelectorAll('.view-product-btn');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            showProductModal(productId);
        });
    });

    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });

    // Order button functionality
    const orderButtons = document.querySelectorAll('.order-btn');
    orderButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            // Implement order functionality here
            showToast('Order functionality coming soon!');
        });
    });
});

function updateHeartIcon(button) {
    const heartIcon = button.querySelector('.heart-icon');
    const isWishlisted = button.dataset.favorited === 'true';

    if (isWishlisted) {
        heartIcon.setAttribute('fill', 'currentColor');
        heartIcon.setAttribute('stroke', 'currentColor');
        heartIcon.classList.remove('text-gray-600', 'group-hover:text-red-500');
        heartIcon.classList.add('text-red-500');
    } else {
        heartIcon.setAttribute('fill', 'none');
        heartIcon.setAttribute('stroke', 'currentColor');
        heartIcon.classList.remove('text-red-500');
        heartIcon.classList.add('text-gray-600', 'group-hover:text-red-500');
    }
}

function showProductModal(productId) {
    // In a real application, you would fetch product details via AJAX
    // For now, we'll show a placeholder
    const modal = document.getElementById('productModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    
    modalTitle.textContent = 'Product Details';
    modalContent.innerHTML = `
        <div class="text-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-orange-500 mx-auto"></div>
            <p class="mt-2 text-gray-600">Loading product details...</p>
        </div>
    `;
    
    modal.classList.remove('hidden');
    
    // Simulate loading (replace with actual AJAX call)
    setTimeout(() => {
        modalContent.innerHTML = `
            <p class="text-gray-600 mb-4">Detailed product information would be displayed here.</p>
            <p class="text-sm text-gray-500">Product ID: ${productId}</p>
        `;
    }, 1000);
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-all duration-300';
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.add('translate-x-0');
    }, 100);
    
    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            if (document.body.contains(toast)) {
                document.body.removeChild(toast);
            }
        }, 300);
    }, 3000);
}
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</x-app-layout>