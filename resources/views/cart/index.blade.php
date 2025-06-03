{{-- resources/views/cart/index.blade.php --}}
<x-app-layout>
    <div class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Shopping Cart</h1>
                        <p class="text-gray-600">Review your items before checkout</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors">
                        Continue Shopping
                    </a>
                </div>
            </div>

            @if($cartItems->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="p-6">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Cart Items ({{ $cartItems->sum('quantity') }})</h2>
                                
                                <div class="space-y-4" id="cartItems">
                                    @foreach($cartItems as $item)
                                        <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg cart-item" data-cart-id="{{ $item->id }}">
                                            <!-- Product Image -->
                                            <div class="flex-shrink-0">
                                                @if($item->product->image_path)
                                                    <img src="{{ Storage::url($item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded-lg">
                                                @else
                                                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-red-500 rounded-lg flex items-center justify-center">
                                                        <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Product Info -->
                                            <div class="flex-1">
                                                <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                                                <p class="text-sm text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }} each</p>
                                                @if($item->notes)
                                                    <p class="text-xs text-gray-500 mt-1">Note: {{ $item->notes }}</p>
                                                @endif
                                            </div>

                                            <!-- Quantity Controls -->
                                            <p class="text-sm text-gray-700">Quantity: {{ $item->quantity }}</p>

                                            <!-- Subtotal & Remove -->
                                            <div class="text-right">
                                                <p class="font-semibold text-gray-900 subtotal" data-cart-id="{{ $item->id }}">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                                <button class="text-red-500 hover:text-red-700 text-sm mt-1 remove-item" data-cart-id="{{ $item->id }}">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-md p-6 sticky top-8">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="font-medium" id="cartSubtotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Delivery Fee</span>
                                    <span class="font-medium">Rp {{ number_format(5000, 0, ',', '.') }}</span>
                                </div>
                                <div class="border-t border-gray-200 pt-3">
                                    <div class="flex justify-between">
                                        <span class="text-lg font-semibold text-gray-900">Total</span>
                                        <span class="text-lg font-bold text-orange-600" id="cartTotal">Rp {{ number_format($total + 5000, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('orders.checkout') }}" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors text-center block">
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <svg class="mx-auto h-24 w-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.6 8H19M7 13v8a2 2 0 002 2h8a2 2 0 002-2v-8m-8 4h4"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Your cart is empty</h3>
                    <p class="text-gray-600 mb-6">Add some delicious food items to get started!</p>
                    <a href="{{ route('dashboard') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.quantity-btn').forEach(btn => {
                btn.addEventListener('click', async function () {
                    const action = this.dataset.action;
                    const cartId = this.dataset.cartId;
                    const quantitySpan = document.querySelector(`.quantity-display[data-cart-id="${cartId}"]`);
                    let currentQuantity = parseInt(quantitySpan.textContent);

                    if (action === 'increase' && currentQuantity < 10) {
                        currentQuantity++;
                    } else if (action === 'decrease' && currentQuantity > 1) {
                        currentQuantity--;
                    } else {
                        return;
                    }

                    await updateCartQuantity(cartId, currentQuantity);
                });
            });

            document.querySelectorAll('.remove-item').forEach(btn => {
                btn.addEventListener('click', async function () {
                    const cartId = this.dataset.cartId;
                    await removeCartItem(cartId);
                });
            });

            document.getElementById('clearCart')?.addEventListener('click', async function () {
                if (confirm('Are you sure you want to clear all items from your cart?')) {
                    await clearCart();
                }
            });
        });

        async function updateCartQuantity(cartId, quantity) {
            try {
                const response = await fetch(`/cart/${cartId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ quantity })
                });

                const data = await response.json();

                if (data.success) {
                    document.querySelector(`.quantity-display[data-cart-id="${cartId}"]`).textContent = quantity;
                    document.querySelector(`.subtotal[data-cart-id="${cartId}"]`).textContent = `Rp ${data.subtotal.toLocaleString('id-ID')}`;
                    updateCartTotals(data.total);
                    showToast(data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.');
            }
        }

        async function removeCartItem(cartId) {
            try {
                const response = await fetch(`/cart/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    document.querySelector(`.cart-item[data-cart-id="${cartId}"]`).remove();
                    showToast(data.message);
                    if (document.querySelectorAll('.cart-item').length === 0) {
                        location.reload();
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.');
            }
        }

        async function clearCart() {
            try {
                const response = await fetch('/cart/clear', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    location.reload();
                }
            } catch (error) {
                console.error('Error:', error);
                showToast('Something went wrong. Please try again.');
            }
        }

        function updateCartTotals(newSubtotal) {
            const deliveryFee = 5000;
            const total = newSubtotal + deliveryFee;
            document.getElementById('cartSubtotal').textContent = `Rp ${newSubtotal.toLocaleString('id-ID')}`;
            document.getElementById('cartTotal').textContent = `Rp ${total.toLocaleString('id-ID')}`;
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
</x-app-layout>
