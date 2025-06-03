{{-- resources/views/orders/checkout.blade.php --}}
<x-app-layout>
    <div class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout</h1>
                <p class="text-gray-600">Complete your order</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Order Form -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Delivery Information</h2>
                    
                    <form id="checkoutForm">
                        @csrf
                        <div class="space-y-4">
                            <!-- Delivery Address -->
                            <div>
                                <label for="delivery_address" class="block text-sm font-medium text-gray-700 mb-2">Delivery Address</label>
                                <textarea id="delivery_address" 
                                         name="delivery_address" 
                                         rows="3" 
                                         class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500" 
                                         placeholder="Enter your complete delivery address..."
                                         required></textarea>
                                <p class="text-xs text-gray-500 mt-1">Please provide detailed address including street name, building number, and landmarks</p>
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" 
                                       id="phone_number" 
                                       name="phone_number" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500" 
                                       placeholder="08123456789"
                                       required>
                            </div>

                            <!-- Order Notes -->
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Special Instructions (Optional)</label>
                                <textarea id="notes" 
                                         name="notes" 
                                         rows="2" 
                                         class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500" 
                                         placeholder="Any special requests or instructions..."></textarea>
                            </div>

                            <!-- Payment Method -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="radio" name="payment_method" value="cod" class="text-orange-500" checked>
                                        <span class="ml-2 text-sm text-gray-700">Cash on Delivery (COD)</span>
                                    </label>
                                    <label class="flex items-center opacity-50">
                                        <input type="radio" name="payment_method" value="online" disabled>
                                        <span class="ml-2 text-sm text-gray-500">Online Payment (Coming Soon)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" 
                                    id="placeOrderBtn"
                                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors">
                                Place Order
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Order Summary</h2>
                    
                    <!-- Order Items -->
                    <div class="space-y-4 mb-6">
                        @foreach($cartItems as $item)
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    @if($item->product->image_path)
                                        <img src="{{ Storage::url($item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded-lg">
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-red-500 rounded-lg flex items-center justify-center">
                                            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900 text-sm">{{ $item->product->name }}</h4>
                                    <p class="text-xs text-gray-600">{{ $item->quantity }}x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    @if($item->notes)
                                        <p class="text-xs text-gray-500">Note: {{ $item->notes }}</p>
                                    @endif
                                </div>
                                <div class="text-sm font-medium text-gray-900">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Totals -->
                    <div class="border-t border-gray-200 pt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                            <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Delivery Fee</span>
                            <span class="font-medium">Rp {{ number_format($deliveryFee, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-semibold pt-2 border-t border-gray-200">
                            <span class="text-gray-900">Total</span>
                            <span class="text-orange-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Back to Cart -->
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('cart.index') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutForm = document.getElementById('checkoutForm');
        const placeOrderBtn = document.getElementById('placeOrderBtn');

        checkoutForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Disable button and show loading
            placeOrderBtn.disabled = true;
            placeOrderBtn.innerHTML = `
                <div class="flex items-center justify-center">
                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
                    Processing...
                </div>
            `;

            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('{{ route("orders.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    showToast(result.message);
                    setTimeout(() => {
                        window.location.href = result.redirect_url;
                    }, 1500);
                } else {
                    showToast(result.message || 'Something went wrong. Please try again.');
                    resetButton();
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.');
                resetButton();
            }
        });

        function resetButton() {
            placeOrderBtn.disabled = false;
            placeOrderBtn.innerHTML = 'Place Order';
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
    });
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</x-app-layout>