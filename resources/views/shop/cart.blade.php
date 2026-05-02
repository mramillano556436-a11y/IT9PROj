<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-700">Your Selection</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Shopping Cart</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="ui-btn-secondary">Continue Shopping</a>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl">
            @if(session('success'))
                <div class="ui-alert-success mb-4">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="ui-alert-danger mb-4">{{ session('error') }}</div>
            @endif

            @if($items)
                <div class="grid gap-6 xl:grid-cols-[1.5fr,0.75fr]">
                    <section class="ui-card overflow-x-auto">
                        <form action="{{ route('shop.update') }}" method="POST">
                            @csrf
                            <table class="ui-table w-full">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/80">
                                    @foreach($items as $item)
                                        <tr class="hover:bg-amber-50/60">
                                            <td class="font-semibold text-slate-900">{{ $item['product']->name }}</td>
                                            <td class="text-slate-600">PHP {{ number_format($item['product']->price, 2) }}</td>
                                            <td>
                                                <input type="number" name="quantities[{{ $item['product']->id }}]" min="1" value="{{ $item['quantity'] }}" class="ui-input max-w-24">
                                            </td>
                                            <td class="font-semibold text-slate-900">PHP {{ number_format($item['subtotal'], 2) }}</td>
                                            <td>
                                                <a href="{{ route('shop.remove', $item['product']->id) }}" class="ui-btn-danger px-4 py-2 text-sm">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-5">
                                <button type="submit" class="ui-btn-primary">Update Cart</button>
                            </div>
                        </form>
                    </section>

                    <section class="ui-card h-fit">
                        <p class="text-xs font-semibold uppercase tracking-[0.26em] text-amber-700">Summary</p>
                        <div class="mt-5 flex items-center justify-between border-b border-amber-100 pb-4">
                            <span class="text-lg font-semibold text-slate-900">Total</span>
                            <span class="text-3xl font-bold text-slate-900">PHP {{ number_format($total, 2) }}</span>
                        </div>

                        <div class="mt-5 grid gap-3">
                            @auth
                                <a href="{{ route('shop.checkout') }}" class="ui-btn-primary w-full">Proceed to Checkout</a>
                            @else
                                <p class="text-sm text-slate-500">Please log in to proceed with checkout.</p>
                                <a href="{{ route('login') }}" class="ui-btn-accent w-full">Login to Checkout</a>
                            @endauth

                            <a href="{{ route('shop.index') }}" class="ui-btn-secondary w-full">Continue Shopping</a>
                        </div>
                    </section>
                </div>
            @else
                <div class="ui-card py-12 text-center">
                    <p class="text-lg text-slate-500">Your cart is empty.</p>
                    <a href="{{ route('shop.index') }}" class="ui-btn-primary mt-5">Start Shopping</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
