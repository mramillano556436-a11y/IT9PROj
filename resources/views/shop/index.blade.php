<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-xs font-bold uppercase tracking-[0.28em] text-amber-900">ABIBAS Collection</p>
                <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Find your next pair</h2>
                <p class="mt-2 text-sm text-slate-600">Browse the latest running, casual, formal, and sport releases in a full product grid.</p>
            </div>
            <a href="{{ route('shop.cart') }}" class="ui-btn-accent">
                View Cart
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <span class="rounded-full bg-slate-900 px-2 py-1 text-xs text-white">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            @if(session('success'))
                <div class="ui-alert-success mb-6">{{ session('success') }}</div>
            @endif

            <div class="mb-8 ui-card bg-[radial-gradient(circle_at_top_left,_rgba(255,211,109,0.32),_transparent_26%),linear-gradient(135deg,#17213d_0%,#223559_62%,#d39b2f_100%)] text-white">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-200">Featured Drop</p>
                <h3 class="mt-3 text-4xl font-bold tracking-tight">Move louder. Land lighter.</h3>
                <p class="mt-3 max-w-2xl text-sm text-slate-200">A stronger shop interface with color-coded labels, card-based browsing, and clearer buttons.</p>
            </div>

            <div class="mb-8 grid gap-4 md:grid-cols-4">
                <div class="ui-card-tight bg-amber-50">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-amber-900">Grid Layout</p>
                    <p class="mt-2 text-sm text-slate-700">Browse products in a clear card-based grid.</p>
                </div>
                <div class="ui-card-tight bg-blue-50">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-blue-900">Visible Labels</p>
                    <p class="mt-2 text-sm text-slate-700">Category and stock badges stand out immediately.</p>
                </div>
                <div class="ui-card-tight bg-emerald-50">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-emerald-900">Action Ready</p>
                    <p class="mt-2 text-sm text-slate-700">Primary buttons are stronger and easier to find.</p>
                </div>
                <div class="ui-card-tight bg-rose-50">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-rose-900">Quick Compare</p>
                    <p class="mt-2 text-sm text-slate-700">Cards keep price, stock, and details aligned.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
                @forelse($products as $product)
                    <div class="ui-card overflow-hidden p-0">
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-56 w-full object-cover">
                        @else
                            <div class="flex h-56 items-center justify-center bg-amber-50 text-sm font-semibold uppercase tracking-[0.18em] text-slate-400">
                                Product Preview
                            </div>
                        @endif

                        <div class="p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="inline-flex rounded-full bg-slate-900 px-3 py-2 text-xs font-bold uppercase tracking-[0.18em] text-white">{{ $product->category }}</p>
                                    <h3 class="mt-3 text-xl font-black text-slate-900">{{ $product->name }}</h3>
                                </div>
                                <span class="rounded-full bg-amber-100 px-3 py-2 text-xs font-bold text-amber-900">Stock {{ $product->stock }}</span>
                            </div>

                            <p class="mt-3 min-h-[3rem] text-sm leading-6 text-slate-600">
                                {{ $product->description ?? 'No description available yet.' }}
                            </p>

                            <div class="mt-5 flex items-center justify-between">
                                <span class="text-2xl font-black text-slate-900">PHP {{ number_format($product->price, 2) }}</span>
                                @if($product->stock <= 5)
                                    <span class="ui-badge-warning">Low stock</span>
                                @endif
                            </div>

                            <div class="mt-5 grid gap-3">
                                <a href="{{ route('shop.show', $product->id) }}" class="ui-btn-secondary w-full">
                                    View Details
                                </a>

                                @if($product->stock > 0)
                                    <form action="{{ route('shop.add', $product->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="ui-btn-primary w-full">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="ui-btn-secondary w-full opacity-60">
                                        Out of Stock
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="ui-card col-span-full py-12 text-center">
                        <p class="text-lg text-slate-500">No products available yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
