<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-amber-700">{{ $product->category }}</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $product->name }}</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="ui-btn-secondary">Back to Shop</a>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl">
            <div class="ui-card grid gap-8 lg:grid-cols-2">
                <div>
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-[28rem] w-full rounded-3xl object-cover">
                    @else
                        <div class="flex h-[28rem] items-center justify-center rounded-3xl bg-amber-50 text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">
                            Product Preview
                        </div>
                    @endif
                </div>

                <div class="flex flex-col justify-center">
                    <span class="ui-badge-neutral w-fit">{{ $product->stock > 0 ? 'Available now' : 'Sold out' }}</span>
                    <h1 class="mt-4 text-4xl font-bold tracking-tight text-slate-900">{{ $product->name }}</h1>
                    <p class="mt-3 text-lg text-slate-500">{{ $product->description ?? 'No description available.' }}</p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div class="ui-card-tight">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Price</p>
                            <p class="mt-2 text-3xl font-bold text-slate-900">PHP {{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="ui-card-tight">
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Stock Available</p>
                            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $product->stock }}</p>
                        </div>
                    </div>

                    @if($product->stock > 0)
                        <form action="{{ route('shop.add', $product->id) }}" method="POST" class="mt-8 space-y-4">
                            @csrf
                            <div>
                                <label for="quantity" class="ui-label">Quantity</label>
                                <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1" class="ui-input max-w-32">
                            </div>
                            <button type="submit" class="ui-btn-primary w-full sm:w-auto">
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <div class="ui-alert-danger mt-8">This product is currently out of stock.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
