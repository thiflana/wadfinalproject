<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center justify-center">
                <img src="/logo.png" alt="Logo" class="w-40 h-23">
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('admin.analytics') }}" class="text-gray-700 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                    View Analytics
                </a>
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                    Home
                </a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                    Product Listings
                </a>
                <a href="{{ route('wishlist.index') }}" class="text-gray-700 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                    My Wishlists
                </a>

                <!-- Authenticated User Actions -->
                @auth
                    <div class="flex items-center space-x-4 ml-4">
                        <!-- Cart Icon -->
                        <a href="{{ route('cart.index') }}" class="relative flex items-center text-gray-600 hover:text-orange-500 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.6 8H19M7 13v8a2 2 0 002 2h8a2 2 0 002-2v-8m-8 4h4"></path>
                            </svg>
                            @if(auth()->user()->cart_count > 0)
                                <span id="cartCount" class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ auth()->user()->cart_count }}
                                </span>
                            @endif
                        </a>

                        <!-- Orders Icon -->
                        <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-orange-500 transition-colors">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </a>

                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-orange-300 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                Sign Out
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
