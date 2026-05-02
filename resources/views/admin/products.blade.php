<x-admin-layout title="Products" subtitle="Manage catalog entries with clearer actions and stronger visual hierarchy.">
    @if(session('success'))
        <div class="ui-alert-success">{{ session('success') }}</div>
    @endif

    <section class="ui-card">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.26em] text-amber-700">Catalog</p>
                <h3 class="mt-2 text-xl font-bold text-slate-900">All products</h3>
            </div>
            <a href="{{ route('admin.products.create') }}" class="ui-btn-primary">Add Product</a>
        </div>

        <div class="mt-6 grid gap-3 md:grid-cols-3">
            <input type="text" placeholder="Search products..." class="ui-input">
            <select class="ui-input">
                <option>All categories</option>
                <option>Running</option>
                <option>Casual</option>
                <option>Formal</option>
            </select>
            <select class="ui-input">
                <option>All stock levels</option>
                <option>In stock</option>
                <option>Low stock</option>
                <option>Out of stock</option>
            </select>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="ui-table w-full">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white/80">
                    @forelse($products as $product)
                        <tr class="hover:bg-amber-50/60">
                            <td>
                                <div class="flex items-center gap-4">
                                    <div class="h-14 w-14 overflow-hidden rounded-2xl border border-amber-100 bg-amber-50">
                                        @if($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full items-center justify-center text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">No Img</div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $product->name }}</p>
                                        <p class="mt-1 text-xs uppercase tracking-[0.16em] text-slate-500">ID {{ $product->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-slate-600">{{ $product->category }}</td>
                            <td class="font-semibold text-slate-900">PHP {{ number_format($product->price, 2) }}</td>
                            <td>
                                @if($product->stock > 20)
                                    <span class="ui-badge-success">In stock ({{ $product->stock }})</span>
                                @elseif($product->stock > 0)
                                    <span class="ui-badge-warning">Low stock ({{ $product->stock }})</span>
                                @else
                                    <span class="ui-badge-danger">Out of stock</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="ui-btn-secondary px-4 py-2 text-sm">Edit</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ui-btn-danger px-4 py-2 text-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-500">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-admin-layout>
