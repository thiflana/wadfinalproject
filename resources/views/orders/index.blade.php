<x-app-layout>
    <div class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">My Orders</h1>
                        <p class="text-gray-600">Check the status and details of your past orders</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
                        Back to Dashboard
                    </a>
                </div>
            </div>

            @if($orders->count())
                <div class="space-y-6">
                   @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Order #{{ $order->id }}</h2>
                                <p class="text-sm text-gray-600">Placed on {{ $order->created_at->format('d M Y, H:i') }}</p>
                                <p class="text-sm text-gray-500 mt-1">Status: 
                                    <span class="font-medium {{ $order->status === 'completed' ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500 mb-1">Total (including delivery):</p>
                                <p class="text-xl font-bold text-orange-600">
                                    Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 border-t pt-4 text-sm text-gray-700">
                            <p class="font-semibold mb-2">Items:</p>
                            <ul class="space-y-1">
                                @foreach($order->items as $item)
                                    <li>
                                        {{ $item->product->name }} × {{ $item->quantity }} 
                                        <span class="text-gray-500"> - Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

        <!-- Add button here -->
        <div class="mt-4">
            <a href="{{ route('orders.show', $order->id) }}" 
               class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
                View Details
            </a>
        </div>
    </div>
@endforeach


                    <div class="mt-8">
                        {{ $orders->links() }} {{-- Laravel pagination --}}
                    </div>
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-xl shadow-md">
                    <svg class="mx-auto h-20 w-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h18M9 3v18m6-18v18M3 21h18"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No orders yet</h3>
                    <p class="text-gray-500 mb-4">You haven't placed any orders. Start shopping now!</p>
                    <a href="{{ route('dashboard') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg">
                        Browse Products
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
