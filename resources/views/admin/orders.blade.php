<x-admin-layout title="Orders" subtitle="Track fulfillment status with more visible badges and stronger action buttons.">
    @if(session('success'))
        <div class="ui-alert-success">{{ session('success') }}</div>
    @endif

    <section class="ui-card">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.26em] text-amber-700">Order Queue</p>
                <h3 class="mt-2 text-xl font-bold text-slate-900">Customer orders</h3>
            </div>
            <div class="flex flex-wrap gap-2">
                <span class="ui-badge-neutral">All</span>
                <span class="ui-badge-warning">Processing</span>
                <span class="ui-badge-success">Shipped</span>
                <span class="ui-badge-neutral">Delivered</span>
            </div>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="ui-table w-full">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white/80">
                    @forelse($orders as $order)
                        <tr class="hover:bg-amber-50/60">
                            <td class="font-mono text-sm text-slate-600">#STR-{{ $order->id }}</td>
                            <td class="font-semibold text-slate-900">{{ $order->user->name }}</td>
                            <td class="text-slate-600">{{ $order->items_count }} {{ $order->items_count == 1 ? 'item' : 'items' }}</td>
                            <td class="font-semibold text-slate-900">PHP {{ number_format($order->total, 2) }}</td>
                            <td>
                                @if($order->status == 'processing')
                                    <span class="ui-badge-warning">Processing</span>
                                @elseif($order->status == 'shipped')
                                    <span class="ui-badge-success">Shipped</span>
                                @elseif($order->status == 'pending')
                                    <span class="ui-badge-neutral">Pending</span>
                                @else
                                    <span class="ui-badge-success">Delivered</span>
                                @endif
                            </td>
                            <td>
                                @if($order->status != 'delivered')
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="ui-btn-primary px-4 py-2 text-sm">Update</a>
                                @else
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="ui-btn-secondary px-4 py-2 text-sm">View</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-slate-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-admin-layout>
