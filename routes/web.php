<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// Public Shop Routes
Route::get('/', function () {
    return view('welcome-home');
})->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');

// Shopping Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('shop.cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('shop.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('shop.remove');
Route::post('/cart/update', [CartController::class, 'update'])->name('shop.update');
Route::get('/checkout', [CartController::class, 'checkout'])->name('shop.checkout');
Route::post('/checkout', [CartController::class, 'store'])->name('shop.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer Routes
Route::prefix('customer')->middleware(['auth', 'customer'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('customer.orders');
    Route::get('/orders/{id}', [CustomerController::class, 'orderDetail'])->name('customer.order.detail');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::resource('products', ProductController::class, ['as' => 'admin']);
    Route::resource('orders', OrderController::class, ['as' => 'admin']);
    Route::resource('users', UserController::class, ['as' => 'admin']);
});

require __DIR__.'/auth.php';
