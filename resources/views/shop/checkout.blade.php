<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h3>

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-900 mb-3">Items:</h4>
                        @php
                            $total = 0;
                        @endphp
                        <ul class="space-y-2">
                            @foreach($cart as $id => $quantity)
                                @php
                                    $product = \App\Models\Product::find($id);
                                    if($product) {
                                        $subtotal = $product->price * $quantity;
                                        $total += $subtotal;
                                    }
                                @endphp
                                @if($product)
                                    <li class="flex justify-between text-gray-600">
                                        <span>{{ $product->name }} x {{ $quantity }}</span>
                                        <span class="font-semibold">${{ number_format($subtotal, 2) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between items-center text-lg">
                            <span class="font-semibold text-gray-900">Total:</span>
                            <span class="text-2xl font-bold text-blue-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded p-4 mb-6">
                        <p class="text-sm text-blue-800">
                            <strong>Note:</strong> This is a demo checkout. In a production system, you would integrate with a payment gateway like Stripe.
                        </p>
                    </div>

                    <form method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block font-semibold text-gray-900 mb-2">Shipping Address</label>
                            <textarea name="address" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded" placeholder="Enter your shipping address" required></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-semibold text-gray-900 mb-2">City</label>
                                <input type="text" name="city" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                            </div>
                            <div>
                                <label class="block font-semibold text-gray-900 mb-2">ZIP Code</label>
                                <input type="text" name="zip" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded transition">
                            Complete Order
                        </button>

                        <a href="{{ route('shop.cart') }}" class="block w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 rounded text-center transition">
                            Back to Cart
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
