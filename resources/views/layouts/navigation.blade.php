<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center justify-center">
                <img src="/logo.png" alt="Logo" class="w-40 h-23">
            </div>

            <!-- Navigation Links -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                        Home
                    </a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                        Product Listings
                    </a>
                    <a href="{{ route('wishlist.index') }}" class="text-gray-700 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                        My Wishlists
                    </a>
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-orange-600 text-sm font-medium transition-colors duration-200">
                        Profile
                    </a>
                </div>

                <!-- Sign Out Button -->
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-orange-300 px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>