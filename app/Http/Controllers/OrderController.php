<?php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
    if ($order->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $order->load('items.product');

    return view('orders.show', compact('order'));
    }   

    public function checkout()
    {
        $cartItems = Auth::user()->cart()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $subtotal = $cartItems->sum('subtotal');
        $deliveryFee = 5000; // Fixed delivery fee, you can make this dynamic
        $total = $subtotal + $deliveryFee;

        return view('orders.checkout', compact('cartItems', 'subtotal', 'deliveryFee', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:500',
            'phone_number' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500'
        ]);

        $cartItems = Auth::user()->cart()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty!'
            ], 400);
        }

        DB::transaction(function () use ($request, $cartItems) {
            $subtotal = $cartItems->sum('subtotal');
            $deliveryFee = 5000;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'delivery_address' => $request->delivery_address,
                'phone_number' => $request->phone_number,
                'notes' => $request->notes
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product->name,
                    'price' => $cartItem->price,
                    'quantity' => $cartItem->quantity,
                    'notes' => $cartItem->notes
                ]);
            }

            // Clear cart
            Auth::user()->cart()->delete();

            $this->order = $order;
        });

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_id' => $this->order->id,
            'redirect_url' => route('orders.show', $this->order)
        ]);
    }

    private $order;
}