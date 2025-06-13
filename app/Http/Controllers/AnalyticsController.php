<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $showHidden = $request->input('show_hidden'); // Checkbox input

        Log::info('Search Query:', ['query' => $query]);

        // Fetch valid orders including paid & pending
        $validOrderIds = Order::whereIn('payment_status', ['paid', 'pending'])->pluck('id');

        if (empty($query)) {
            // Show all products when search bar is empty, respecting the hidden filter
            $filteredProducts = OrderItem::whereIn('order_id', $validOrderIds)
                ->with('product:id,name,price,image_path')
                ->select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(total) as total_revenue'))
                ->groupBy('product_id');

            if (!$showHidden) {
                $filteredProducts->whereHas('product', function ($query) {
                    $query->where('hidden', false);
                });
            }

            $filteredProducts = $filteredProducts->get();
        } else {
            // When searching, show only matching products that aren't hidden
            $filteredProducts = OrderItem::whereIn('order_id', $validOrderIds)
                ->whereHas('product', function ($subQuery) use ($query, $showHidden) {
                    $subQuery->where('name', 'like', "%{$query}%");
                    if (!$showHidden) {
                        $subQuery->where('hidden', false);
                    }
                })
                ->with('product:id,name,price,image_path')
                ->select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(total) as total_revenue'))
                ->groupBy('product_id')
                ->get();
        }

        Log::info('Filtered Products:', ['filteredProducts' => $filteredProducts]);

        return view('admin.analytics', [
            'totalProductsSold' => OrderItem::whereIn('order_id', $validOrderIds)->sum('quantity'),
            'totalRevenue' => OrderItem::whereIn('order_id', $validOrderIds)->sum('total'),
            'pendingProducts' => OrderItem::whereIn('order_id', Order::where('payment_status', 'pending')->pluck('id'))->sum('quantity'),
            'pendingRevenue' => OrderItem::whereIn('order_id', Order::where('payment_status', 'pending')->pluck('id'))->sum('total'),
            'filteredProducts' => $filteredProducts,
            'showHidden' => $showHidden,
        ]);
    }

    public function removeFromSearch(Product $product)
    {
        $product->update(['hidden' => true]); // Mark product as hidden

        return redirect()->route('admin.analytics')->with('success', 'Product removed from search!');
    }
}
