<x-admin-layout title="Update Order" subtitle="Adjust fulfillment status with a more legible review panel and clear action buttons.">
    @if ($errors->any())
        <div class="ui-alert-danger">
            <strong class="font-semibold">Please fix the following errors:</strong>
            <ul class="mt-2 list-disc ps-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="grid gap-6 lg:grid-cols-[0.9fr,1.1fr]">
        <div class="ui-card">
            <p class="text-xs font-semibold uppercase tracking-[0.26em] text-amber-700">Order Summary</p>
            <div class="mt-5 space-y-4">
                <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Order ID</span><span class="font-semibold text-slate-900">#STR-{{ $order->id }}</span></div>
                <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Customer</span><span class="font-semibold text-slate-900">{{ $order->user->name }}</span></div>
                <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Total</span><span class="font-semibold text-slate-900">PHP {{ number_format($order->total, 2) }}</span></div>
                <div class="ui-card-tight flex items-center justify-between"><span class="text-slate-500">Items</span><span class="font-semibold text-slate-900">{{ $order->items_count }}</span></div>
            </div>
        </div>

        <div class="ui-card">
            <form method="POST" action="{{ route('admin.orders.update', $order->id) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="status" class="ui-label">Order Status</label>
                    <select id="status" name="status" required class="ui-input">
                        <option value="">Select status</option>
                        <option value="processing" @selected(old('status', $order->status) == 'processing')>Processing</option>
                        <option value="shipped" @selected(old('status', $order->status) == 'shipped')>Shipped</option>
                        <option value="delivered" @selected(old('status', $order->status) == 'delivered')>Delivered</option>
                    </select>
                </div>

                <div>
                    <label for="notes" class="ui-label">Notes</label>
                    <textarea id="notes" name="notes" class="ui-input min-h-[160px]">{{ old('notes', $order->notes) }}</textarea>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="ui-btn-primary">Update Order</button>
                    <a href="{{ route('admin.orders.index') }}" class="ui-btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
</x-admin-layout>
