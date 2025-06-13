<x-app>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Sales Analytics</h1>

        <!-- Search Feature -->
        <form method="GET" action="{{ route('admin.analytics') }}" class="mb-6 flex items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product" class="border rounded px-3 py-2 flex-grow">
            <label class="ml-2">
                <input type="checkbox" name="show_hidden" {{ request('show_hidden') ? 'checked' : '' }}>
                Show Hidden Products
            </label>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Search</button>
        </form>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <p class="text-lg">Total Products Sold: <strong>{{ $totalProductsSold }}</strong></p>
            <p class="text-lg">Total Revenue: <strong>${{ number_format($totalRevenue, 2) }}</strong></p>

            <div class="mt-6 border-t pt-4">
                <p class="text-lg text-yellow-600">Pending Products: <strong>{{ $pendingProducts }}</strong></p>
                <p class="text-lg text-yellow-600">Pending Revenue: <strong>${{ number_format($pendingRevenue, 2) }}</strong></p>
            </div>
        </div>

        @if ($filteredProducts->count())
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">
                    {{ request('search') ? 'Search Results for "' . request('search') . '"' : 'All Products' }}
                </h2>
                @foreach ($filteredProducts as $product)
                    <div class="border-b pb-4 mb-4">
                        <p class="text-lg">Product Name: <strong>{{ $product->product->name ?? 'Unknown' }}</strong></p>
                        <p class="text-lg">Total Sold: <strong>{{ $product->total_sold }}</strong></p>
                        <p class="text-lg">Total Revenue: <strong>${{ number_format($product->total_revenue, 2) }}</strong></p>
                        <div class="mt-4 flex space-x-4">
                            <a href="{{ route('products.edit', $product->product->id) }}" class="bg-yellow-500 text-white px-3 py-2 rounded">Edit</a>
                            <form action="{{ route('admin.analytics.remove', $product->product->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded">Remove from Search</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">No results found for "{{ request('search') }}"</h2>
                <p class="text-lg">Try a different search or check if the product has any orders.</p>
            </div>
        @endif
    </div>
</x-app>
