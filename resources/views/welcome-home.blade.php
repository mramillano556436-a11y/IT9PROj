<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ABIBAS Storefront</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="ui-page-shell min-h-screen">
            @include('layouts.navigation')

            <div class="px-4 pt-6 sm:px-6 lg:px-8">
                <section class="mx-auto grid max-w-7xl gap-6 overflow-hidden rounded-[2rem] bg-[radial-gradient(circle_at_top_left,_rgba(255,211,109,0.34),_transparent_28%),linear-gradient(145deg,#16213e_0%,#203354_55%,#34538a_100%)] px-8 py-12 text-white lg:grid-cols-[1.1fr,0.9fr] lg:px-12">
                    <div class="flex flex-col justify-center">
                        <p class="inline-flex w-fit rounded-full bg-white/12 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-amber-200">ABIBAS Collection</p>
                        <h1 class="mt-6 text-4xl font-black leading-tight sm:text-5xl">Discover standout footwear in a true browsing grid.</h1>
                        <p class="mt-5 max-w-xl text-base leading-7 text-slate-200">Clearer labels, brighter category accents, and product-first browsing designed to feel easier on the eyes.</p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('shop.index') }}" class="ui-btn-accent">Browse All Products</a>
                            @if(!Auth::check())
                                <a href="{{ route('login') }}" class="ui-btn-secondary">Log In</a>
                                <a href="{{ route('register') }}" class="ui-btn-secondary">Create Account</a>
                            @endif
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl border border-white/15 bg-white/10 p-5 backdrop-blur">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-200">Running</p>
                            <p class="mt-3 text-2xl font-bold">Move light</p>
                            <p class="mt-2 text-sm text-slate-100">Performance pairs built for speed and long comfort.</p>
                        </div>
                        <div class="rounded-3xl border border-white/15 bg-white/10 p-5 backdrop-blur">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-200">Casual</p>
                            <p class="mt-3 text-2xl font-bold">Wear daily</p>
                            <p class="mt-2 text-sm text-slate-100">Clean silhouettes for everyday styling.</p>
                        </div>
                        <div class="rounded-3xl border border-white/15 bg-white/10 p-5 backdrop-blur">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-200">Formal</p>
                            <p class="mt-3 text-2xl font-bold">Dress sharp</p>
                            <p class="mt-2 text-sm text-slate-100">Polished options for work and events.</p>
                        </div>
                        <div class="rounded-3xl border border-white/15 bg-white/10 p-5 backdrop-blur">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-200">Sport</p>
                            <p class="mt-3 text-2xl font-bold">Train hard</p>
                            <p class="mt-2 text-sm text-slate-100">Supportive builds for active movement.</p>
                        </div>
                    </div>
                </section>
            </div>

            <div class="px-4 py-12 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-xs font-bold uppercase tracking-[0.28em] text-amber-900">Grid Browsing</p>
                            <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Browse Our Collection</h2>
                            <p class="mt-2 text-sm text-slate-600">A cleaner product grid with stronger labels, pricing, and call-to-action buttons.</p>
                        </div>
                        <a href="{{ route('shop.index') }}" class="ui-btn-primary">Open Full Shop</a>
                    </div>

                    @if(!Auth::check())
                        <div class="mb-8 rounded-3xl border border-amber-200 bg-amber-50 px-6 py-5 text-sm text-slate-700">
                            Log in or create an account to save your cart and place orders faster.
                        </div>
                    @endif

                    @php
                        $products = \App\Models\Product::limit(8)->get();
                    @endphp

                    @if($products->count() > 0)
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
                            @foreach($products as $product)
                                <div class="ui-card overflow-hidden p-0">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-56 w-full object-cover">
                                    @else
                                        <div class="flex h-56 items-center justify-center bg-gradient-to-br from-amber-100 to-white text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">
                                            Product Preview
                                        </div>
                                    @endif
                                    <div class="p-5">
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="rounded-full bg-slate-900 px-3 py-2 text-xs font-bold uppercase tracking-[0.18em] text-white">{{ $product->category }}</span>
                                            <span class="rounded-full bg-amber-100 px-3 py-2 text-xs font-semibold text-amber-900">Stock {{ $product->stock }}</span>
                                        </div>
                                        <h3 class="mt-4 text-xl font-black text-slate-900">{{ $product->name }}</h3>
                                        <p class="mt-2 min-h-[3rem] text-sm leading-6 text-slate-600">{{ $product->description ?: 'Clean, comfortable footwear ready for everyday wear.' }}</p>
                                        <div class="mt-5 flex items-center justify-between">
                                            <p class="text-2xl font-black text-slate-900">PHP {{ number_format($product->price, 2) }}</p>
                                            <a href="{{ route('shop.show', $product->id) }}" class="ui-btn-primary px-4 py-2 text-sm">View Product</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="ui-card p-12 text-center">
                            <p class="text-lg text-slate-500">No products available yet. Please check back soon.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="px-4 pb-12 sm:px-6 lg:px-8">
                <div class="mx-auto grid max-w-7xl gap-6 md:grid-cols-3">
                    <div class="ui-card bg-gradient-to-br from-white to-amber-50">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white">S</div>
                        <h3 class="mt-5 text-2xl font-black text-slate-900">Fast Shipping</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Quick and reliable delivery to your door with better order visibility after checkout.</p>
                    </div>
                    <div class="ui-card bg-gradient-to-br from-white to-blue-50">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-700 text-white">P</div>
                        <h3 class="mt-5 text-2xl font-black text-slate-900">Secure Payment</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Safe and encrypted transactions supported by more obvious call-to-action buttons.</p>
                    </div>
                    <div class="ui-card bg-gradient-to-br from-white to-emerald-50">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-700 text-white">H</div>
                        <h3 class="mt-5 text-2xl font-black text-slate-900">24/7 Support</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Always here to help you with account, cart, and order concerns.</p>
                    </div>
                </div>
            </div>

            <div class="px-4 pb-12 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl rounded-[2rem] bg-[linear-gradient(135deg,#17213d_0%,#2d4d84_100%)] px-8 py-12 text-center text-white">
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-200">Ready to Shop?</p>
                    <h2 class="mt-4 text-4xl font-black">Browse the full ABIBAS lineup.</h2>
                    <p class="mt-3 text-sm text-slate-200">Move into the full shop page for a dedicated product grid browsing experience.</p>
                    <a href="{{ route('shop.index') }}" class="ui-btn-accent mt-6">
                        Browse All Products
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
