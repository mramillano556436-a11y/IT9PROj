<x-admin-layout title="Order Details" subtitle="Read-only view for delivered orders with stronger detail visibility.">
    <section class="ui-card max-w-4xl">
        <div class="grid gap-4 md:grid-cols-2">
            <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Order ID</span><span class="font-semibold text-slate-900">#STR-{{ $order->id }}</span></div>
            <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Customer</span><span class="font-semibold text-slate-900">{{ $order->user->name }}</span></div>
            <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Customer Email</span><span class="font-semibold text-slate-900">{{ $order->user->email }}</span></div>
            <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Items Count</span><span class="font-semibold text-slate-900">{{ $order->items_count }}</span></div>
            <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Total Amount</span><span class="font-semibold text-slate-900">PHP {{ number_format($order->total, 2) }}</span></div>
            <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Status</span><span class="ui-badge-success">{{ ucfirst($order->status) }}</span></div>
            <div class="ui-card-tight flex items-center justify-between md:col-span-2"><span class="text-slate-500">Order Date</span><span class="font-semibold text-slate-900">{{ $order->created_at->format('M d, Y H:i') }}</span></div>
            @if($order->notes)
                <div class="ui-card-tight md:col-span-2">
                    <p class="text-sm font-semibold text-slate-900">Notes</p>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $order->notes }}</p>
                </div>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.orders.index') }}" class="ui-btn-secondary">Back to Orders</a>
        </div>
    </section>
</x-admin-layout>
