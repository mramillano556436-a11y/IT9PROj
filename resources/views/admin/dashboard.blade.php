<x-admin-layout title="Dashboard" subtitle="Quick visibility into store performance and operational activity.">
    <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="ui-card bg-gradient-to-br from-slate-900 to-slate-800 text-white">
            <p class="inline-flex rounded-full bg-white/10 px-3 py-2 text-xs font-bold uppercase tracking-[0.18em] text-neutral-200">Total Revenue</p>
            <p class="mt-4 text-4xl font-bold">PHP {{ number_format($totalRevenue, 2) }}</p>
            <p class="mt-2 text-sm text-slate-300">
                {{ $revenueChange >= 0 ? '+' : '' }}{{ number_format($revenueChange, 1) }}% this month
            </p>
        </div>
        <div class="ui-card bg-gradient-to-br from-white to-neutral-100">
            <p class="inline-flex rounded-full bg-neutral-900 px-3 py-2 text-xs font-bold uppercase tracking-[0.18em] text-white">Orders Today</p>
            <p class="mt-4 text-4xl font-bold text-slate-900">{{ number_format($ordersToday) }}</p>
            <p class="mt-2 text-sm text-slate-500">{{ number_format($processingOrders) }} currently processing</p>
        </div>
        <div class="ui-card bg-gradient-to-br from-white to-neutral-100">
            <p class="inline-flex rounded-full bg-neutral-900 px-3 py-2 text-xs font-bold uppercase tracking-[0.18em] text-white">Products</p>
            <p class="mt-4 text-4xl font-bold text-slate-900">{{ number_format($productCount) }}</p>
            <p class="mt-2 text-sm text-slate-500">{{ number_format($lowStockCount) }} need stock attention</p>
        </div>
        <div class="ui-card bg-gradient-to-br from-white to-neutral-100">
            <p class="inline-flex rounded-full bg-neutral-900 px-3 py-2 text-xs font-bold uppercase tracking-[0.18em] text-white">Customers</p>
            <p class="mt-4 text-4xl font-bold text-slate-900">{{ number_format($customerCount) }}</p>
            <p class="mt-2 text-sm text-slate-500">+{{ number_format($newCustomersThisWeek) }} this week</p>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[1.7fr,1fr]">
        <div class="ui-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="inline-flex rounded-full bg-neutral-900 px-3 py-2 text-xs font-bold uppercase tracking-[0.18em] text-white">Revenue Overview</p>
                    <h3 class="mt-3 text-xl font-black text-slate-900">Weekly performance</h3>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="ui-btn-secondary px-4 py-2 text-sm">Review Orders</a>
            </div>
            <div class="mt-6 rounded-3xl border border-dashed border-neutral-400 bg-neutral-100 p-8">
                <div class="grid h-56 grid-cols-7 items-end gap-3">
                    @foreach($weeklyRevenue as $day)
                        <div class="relative flex h-full items-end">
                            <div class="group flex h-full w-full items-end">
                                <div class="w-full rounded-t-2xl bg-gradient-to-t from-black to-neutral-500 transition duration-200 group-hover:from-neutral-900 group-hover:to-neutral-400" style="height: {{ $day['height'] }}%;">
                                    <div class="invisible -mt-8 text-center text-[11px] font-semibold text-slate-600 group-hover:visible">
                                        PHP {{ number_format($day['revenue'], 2) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 flex justify-between text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">
                    @foreach($weeklyRevenue as $day)
                        <span title="{{ $day['full_label'] }}">{{ $day['label'] }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="ui-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="inline-flex rounded-full bg-neutral-900 px-3 py-2 text-xs font-bold uppercase tracking-[0.18em] text-white">Recent Orders</p>
                    <h3 class="mt-3 text-xl font-black text-slate-900">Live queue</h3>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="ui-link">View all</a>
            </div>

            <div class="mt-6 space-y-4">
                @forelse($recentOrders as $order)
                    <div class="ui-card-tight flex items-center justify-between">
                        <div>
                            <p class="font-mono text-sm text-slate-900">#STR-{{ $order->id }}</p>
                            <p class="mt-1 text-xs uppercase tracking-[0.16em] text-slate-500">{{ $order->user?->name ?? 'Unknown customer' }}</p>
                        </div>
                        @php
                            $badgeClass = match ($order->status) {
                                'pending', 'processing' => 'ui-badge-warning',
                                'shipped', 'delivered', 'completed' => 'ui-badge-success',
                                'cancelled' => 'ui-badge-danger',
                                default => 'ui-badge-neutral',
                            };
                        @endphp
                        <span class="{{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                    </div>
                @empty
                    <div class="ui-card-tight text-sm text-slate-500">
                        No orders recorded yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-admin-layout>
