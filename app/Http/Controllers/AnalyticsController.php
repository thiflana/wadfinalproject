<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
{
    // PAID orders
    $paidOrderIds = Order::where('payment_status', 'paid')->pluck('id');

    $totalProductsSold = OrderItem::whereIn('order_id', $paidOrderIds)->sum('quantity');
    $totalRevenue = OrderItem::whereIn('order_id', $paidOrderIds)->sum('total');

    // PENDING orders
    $pendingOrderIds = Order::where('payment_status', 'pending')->pluck('id');

    $pendingProducts = OrderItem::whereIn('order_id', $pendingOrderIds)->sum('quantity');
    $pendingRevenue = OrderItem::whereIn('order_id', $pendingOrderIds)->sum('total');

    $topProducts = OrderItem::whereIn('order_id', $paidOrderIds)
        ->select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(total) as total_revenue'))
        ->groupBy('product_id')
        ->orderByDesc('total_sold')
        ->with('product:id,name')
        ->take(5)
        ->get();

    return view('admin.analytics', [
        'totalProductsSold' => $totalProductsSold,
        'totalRevenue' => $totalRevenue,
        'pendingProducts' => $pendingProducts,
        'pendingRevenue' => $pendingRevenue,
        'topProducts' => $topProducts
    ]);
}
}
