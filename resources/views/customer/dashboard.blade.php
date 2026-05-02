<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-amber-700">Customer Space</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Welcome back, {{ $user->name }}</h2>
                <p class="mt-2 text-sm text-slate-500">Manage your orders, jump back into shopping, and keep track of what matters.</p>
            </div>
            <a href="{{ route('shop.index') }}" class="ui-btn-accent">Continue Shopping</a>
        </div>
    </x-slot>

    <div class="px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="ui-card bg-gradient-to-br from-slate-900 to-slate-800 text-white md:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-amber-300">Quick Actions</p>
                    <h3 class="mt-3 text-3xl font-bold">Everything you need, easy to see.</h3>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('shop.index') }}" class="ui-btn-accent">Browse Products</a>
                        <a href="{{ route('shop.cart') }}" class="ui-btn-secondary">View Cart</a>
                        <a href="{{ route('customer.orders') }}" class="ui-btn-secondary">All Orders</a>
                    </div>
                </div>
                <div class="ui-card">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Total Orders</p>
                    <p class="mt-4 text-4xl font-bold text-slate-900">{{ $totalOrders }}</p>
                    <a href="{{ route('customer.orders') }}" class="ui-link mt-4 inline-block">Review orders</a>
                </div>
                <div class="ui-card">
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">Total Spent</p>
                    <p class="mt-4 text-4xl font-bold text-slate-900">PHP {{ number_format($totalSpent, 2) }}</p>
                    <a href="{{ route('shop.index') }}" class="ui-link mt-4 inline-block">Shop more</a>
                </div>
            </section>

            <section class="ui-card">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.26em] text-amber-700">Recent Orders</p>
                        <h3 class="mt-2 text-xl font-bold text-slate-900">Latest activity</h3>
                    </div>
                    <a href="{{ route('customer.orders') }}" class="ui-btn-primary">View All Orders</a>
                </div>

                @if($orders->count())
                    <div class="mt-6 overflow-x-auto">
                        <table class="ui-table w-full">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/80">
                                @forelse($orders->take(5) as $order)
                                    <tr class="hover:bg-amber-50/60">
                                        <td class="font-semibold text-slate-900">#{{ $order->id }}</td>
                                        <td class="text-slate-600">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="text-slate-600">{{ $order->items_count }}</td>
                                        <td class="font-semibold text-slate-900">PHP {{ number_format($order->total, 2) }}</td>
                                        <td>
                                            @if($order->status === 'completed' || $order->status === 'delivered')
                                                <span class="ui-badge-success">{{ ucfirst($order->status) }}</span>
                                            @elseif($order->status === 'pending' || $order->status === 'processing')
                                                <span class="ui-badge-warning">{{ ucfirst($order->status) }}</span>
                                            @elseif($order->status === 'cancelled')
                                                <span class="ui-badge-danger">{{ ucfirst($order->status) }}</span>
                                            @else
                                                <span class="ui-badge-neutral">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('customer.order.detail', $order->id) }}" class="ui-btn-secondary px-4 py-2 text-sm">View Details</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-10 text-center text-slate-500">No orders yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="mt-6 rounded-3xl border border-dashed border-amber-300 bg-amber-50/70 px-6 py-12 text-center">
                        <p class="text-lg text-slate-500">You haven't placed any orders yet.</p>
                        <a href="{{ route('shop.index') }}" class="ui-btn-primary mt-5">Start Shopping</a>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
