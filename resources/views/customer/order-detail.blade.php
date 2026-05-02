<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Order #{{ $order->id }}
            </h2>
            <a href="{{ route('customer.orders') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">← Back to Orders</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Order Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Order ID</p>
                            <p class="mt-1 text-lg font-bold text-gray-900">#{{ $order->id }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Order Date</p>
                            <p class="mt-1 text-lg font-bold text-gray-900">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Status</p>
                            <p class="mt-1">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($order->status === 'completed') bg-green-100 text-green-800
                                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @elseif($order->status === 'shipped') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Total Amount</p>
                            <p class="mt-1 text-lg font-bold text-gray-900">${{ number_format($order->total, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Details</h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Number of Items:</span>
                            <span class="font-medium text-gray-900">{{ $order->items_count }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Order Total:</span>
                            <span class="font-medium text-gray-900">${{ number_format($order->total, 2) }}</span>
                        </div>
                        @if($order->notes)
                            <div class="flex justify-between">
                                <span>Notes:</span>
                                <span class="font-medium text-gray-900">{{ $order->notes }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span>Order Placed:</span>
                            <span class="font-medium text-gray-900">{{ $order->created_at->format('M d, Y \a\t H:i A') }}</span>
                        </div>
                        @if($order->updated_at != $order->created_at)
                            <div class="flex justify-between">
                                <span>Last Updated:</span>
                                <span class="font-medium text-gray-900">{{ $order->updated_at->format('M d, Y \a\t H:i A') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Billing Information</h3>
                    <div class="space-y-2 text-gray-600">
                        <p><span class="font-medium text-gray-900">{{ $order->user->name }}</span></p>
                        <p>{{ $order->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
