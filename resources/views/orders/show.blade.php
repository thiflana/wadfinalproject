<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md mt-10">
        <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>
        <p>Placed on: {{ $order->created_at->format('d M Y, H:i') }}</p>
        <p>Status: <span class="{{ $order->status === 'completed' ? 'text-green-600' : 'text-yellow-600' }}">{{ ucfirst($order->status) }}</span></p>
        <p>Delivery Address: {{ $order->delivery_address }}</p>
        <p>Phone Number: {{ $order->phone_number }}</p>
        <p>Notes: {{ $order->notes ?? '-' }}</p>

        <h2 class="mt-6 font-semibold text-lg">Items</h2>
        <ul class="list-disc pl-5">
            @foreach ($order->items as $item)
                <li>
                    {{ $item->product_name }} × {{ $item->quantity }} — Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </li>
            @endforeach
        </ul>

        <p class="mt-6 font-bold text-xl text-orange-600">Total: Rp {{ number_format($order->total_amount + $order->delivery_fee, 0, ',', '.') }}</p>

        <a href="{{ route('orders.index') }}" class="inline-block mt-6 bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
            Back to Orders
        </a>
    </div>
</x-app-layout>
