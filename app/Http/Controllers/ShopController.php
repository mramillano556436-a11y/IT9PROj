<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Show all products for shopping
     */
    public function index()
    {
        $products = Product::paginate(12);
        return view('shop.index', compact('products'));
    }

    /**
     * Show product detail
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }
}
