<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Show customer dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->get();
        $totalOrders = $orders->count();
        $totalSpent = $orders->sum('total');

        return view('customer.dashboard', compact('user', 'orders', 'totalOrders', 'totalSpent'));
    }

    /**
     * Show customer orders
     */
    public function orders()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->paginate(10);

        return view('customer.orders', compact('orders'));
    }

    /**
     * Show single order details
     */
    public function orderDetail($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);

        // Ensure user can only view their own orders
        if ($order->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        return view('customer.order-detail', compact('order'));
    }
}
