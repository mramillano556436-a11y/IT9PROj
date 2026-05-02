<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($orders->count())
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 border-b">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Order ID</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Date</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Items</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Total</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Status</th>
                                        <th class="px-4 py-3 text-left font-semibold text-gray-900">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="px-4 py-3 font-medium text-gray-900">#{{ $order->id }}</td>
                                            <td class="px-4 py-3 text-gray-600">{{ $order->created_at->format('M d, Y') }}</td>
                                            <td class="px-4 py-3 text-gray-600">{{ $order->items_count }}</td>
                                            <td class="px-4 py-3 font-medium text-gray-900">${{ number_format($order->total, 2) }}</td>
                                            <td class="px-4 py-3">
                                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                                    @if($order->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                    @elseif($order->status === 'shipped') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <a href="{{ route('customer.order.detail', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">No orders found.</p>
                            <a href="/" class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-medium">Continue Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
