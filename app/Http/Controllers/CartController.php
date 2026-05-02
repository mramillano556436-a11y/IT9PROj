<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show cart
     */
    public function index()
    {
        $cart = session('cart', []);
        $total = 0;
        $items = [];

        foreach ($cart as $id => $quantity) {
            $product = Product::find($id);
            if ($product) {
                $items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity
                ];
                $total += $product->price * $quantity;
            }
        }

        return view('shop.cart', compact('items', 'total', 'cart'));
    }

    /**
     * Add to cart
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id] += $request->quantity ?? 1;
        } else {
            $cart[$id] = $request->quantity ?? 1;
        }

        session(['cart' => $cart]);

        return redirect()->route('shop.index')->with('success', $product->name . ' added to cart!');
    }

    /**
     * Remove from cart
     */
    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return redirect()->route('shop.cart')->with('success', 'Item removed from cart');
    }

    /**
     * Update cart quantity
     */
    public function update(Request $request)
    {
        $cart = session('cart', []);

        foreach ($request->quantities as $id => $quantity) {
            if ($quantity > 0) {
                $cart[$id] = $quantity;
            } else {
                unset($cart[$id]);
            }
        }

        session(['cart' => $cart]);
        return redirect()->route('shop.cart')->with('success', 'Cart updated');
    }

    /**
     * Checkout
     */
    public function checkout()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.cart')->with('error', 'Cart is empty');
        }

        return view('shop.checkout', compact('cart'));
    }

    /**
     * Store order
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.cart')->with('error', 'Cart is empty');
        }

        $total = 0;
        $itemsCount = 0;

        foreach ($cart as $id => $quantity) {
            $product = \App\Models\Product::find($id);
            if ($product) {
                $total += $product->price * $quantity;
                $itemsCount += $quantity;
            }
        }

        $order = \App\Models\Order::create([
    'user_id'     => auth()->id(),
    'status'      => 'pending',
    'total'       => $total,
    'items_count' => $itemsCount,
    'notes'       => $request->notes ?? null,
]);

// Save each cart item
foreach ($cart as $id => $quantity) {
    $product = \App\Models\Product::find($id);
    if ($product) {
        $order->items()->create([
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'price'      => $product->price,
        ]);
    }
}

        // Clear cart
        session()->forget('cart');

        return redirect()->route('customer.order.detail', $order->id)->with('success', 'Order placed successfully!');
    }
}
