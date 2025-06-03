<x-app>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Sales Analytics</h1>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <p class="text-lg">Total Products Sold: <strong>{{ $totalProductsSold }}</strong></p>
            <p class="text-lg">Total Revenue: <strong>${{ number_format($totalRevenue, 2) }}</strong></p>

            <div class="mt-6 border-t pt-4">
                <p class="text-lg text-yellow-600">Pending Products: <strong>{{ $pendingProducts }}</strong></p>
                <p class="text-lg text-yellow-600">Pending Revenue: <strong>${{ number_format($pendingRevenue, 2) }}</strong></p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Top 5 Best-Selling Products</h2>
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left">Product</th>
                        <th class="px-4 py-2 text-right">Units Sold</th>
                        <th class="px-4 py-2 text-right">Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topProducts as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->product->name ?? 'Unknown' }}</td>
                            <td class="px-4 py-2 text-right">{{ $item->total_sold }}</td>
                            <td class="px-4 py-2 text-right">${{ number_format($item->total_revenue, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
