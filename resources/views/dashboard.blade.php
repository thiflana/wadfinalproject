{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <!-- Main Content -->
    <div class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Search Bar -->
            <div class="mb-8">
                <div class="max-w-md mx-auto">
                    <div class="relative">
                        <input type="text" 
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

            <!-- Featured Restaurants Section -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <svg class="h-6 w-6 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900">Featured Restaurants</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Restaurant Card 1 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                                <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 00-2 2v1.816a2 2 0 00.465 1.286l5.115 5.115a2 2 0 002.83 0l5.115-5.115A2 2 0 0016 6.816V5a2 2 0 00-2-2H4zm8 7a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">New</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">Burger King Campus</h3>
                            <p class="text-gray-600 text-sm mb-2">Grilled burgers and fries, perfect for campus dining</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-yellow-400 text-sm">★</span>
                                    <span class="text-gray-600 text-sm ml-1">4.5</span>
                                </div>
                                <span class="text-gray-500 text-sm">15 min • Rp 15,000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Restaurant Card 2 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center">
                                <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">New</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">Pizza Hut Telkom</h3>
                            <p class="text-gray-600 text-sm mb-2">Delicious pizza with fresh toppings and Asian flavors</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-yellow-400 text-sm">★</span>
                                    <span class="text-gray-600 text-sm ml-1">4.6</span>
                                </div>
                                <span class="text-gray-500 text-sm">25 min • Rp 35,000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Restaurant Card 3 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-48 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center">
                                <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">New</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900 mb-1">Warung Sunda Asli</h3>
                            <p class="text-gray-600 text-sm mb-2">Authentic Sundanese cuisine with traditional flavors</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-yellow-400 text-sm">★</span>
                                    <span class="text-gray-600 text-sm ml-1">4.3</span>
                                </div>
                                <span class="text-gray-500 text-sm">12 min • Rp 25,000</span>
                            </div>
                        </div>
                    </div>
                </div>


            <!-- Foods Section -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <svg class="h-6 w-6 text-orange-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900">Foods</h2>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <!-- Food Item 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-32 bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                                <svg class="h-10 w-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 3a2 2 0 00-2 2v1.816a2 2 0 00.465 1.286l5.115 5.115a2 2 0 002.83 0l5.115-5.115A2 2 0 0016 6.816V5a2 2 0 00-2-2H4zm8 7a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-2 right-2">
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-medium">Rp 25,000</span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-medium text-sm text-gray-900">Beef Burger Deluxe</h4>
                            <p class="text-gray-600 text-xs">Burger King Campus</p>
                        </div>
                    </div>

                    <!-- Food Item 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-32 bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center">
                                <svg class="h-10 w-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-2 right-2">
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-medium">Rp 35,000</span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-medium text-sm text-gray-900">Margherita Pizza</h4>
                            <p class="text-gray-600 text-xs">Pizza Hut Telkom</p>
                        </div>
                    </div>

                    <!-- Food Item 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-32 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center">
                                <svg class="h-10 w-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-2 right-2">
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-medium">Rp 18,000</span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-medium text-sm text-gray-900">Nasi Gudeg Jogja</h4>
                            <p class="text-gray-600 text-xs">Warung Sunda Asli</p>
                        </div>
                    </div>

                    <!-- Food Item 4 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-32 bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center">
                                <svg class="h-10 w-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-2 right-2">
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-medium">Rp 22,000</span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-medium text-sm text-gray-900">Ayam Geprek Sambal Matah</h4>
                            <p class="text-gray-600 text-xs">Geprek Bensu</p>
                        </div>
                    </div>

                    <!-- Food Item 5 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-32 bg-gradient-to-br from-amber-500 to-yellow-600 flex items-center justify-center">
                                <svg class="h-10 w-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                                    <path d="M3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-2 right-2">
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-medium">Rp 12,000</span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-medium text-sm text-gray-900">Cappuccino Premium</h4>
                            <p class="text-gray-600 text-xs">Starbucks Campus</p>
                        </div>
                    </div>

                    <!-- Food Item 6 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <div class="h-32 bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center">
                                <svg class="h-10 w-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                                </svg>
                            </div>
                            <div class="absolute top-2 right-2">
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-medium">Rp 15,000</span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-medium text-sm text-gray-900">Es Krim Cokelat</h4>
                            <p class="text-gray-600 text-xs">Sweet Mobster</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>