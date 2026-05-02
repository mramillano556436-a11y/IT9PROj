<x-admin-layout title="Edit Product" subtitle="Update product details without losing image visibility or action clarity.">
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

    <section class="ui-card max-w-4xl">
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-[1.3fr,0.7fr]">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <label for="name" class="ui-label">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required class="ui-input">
                </div>

                <div>
                    <label for="category" class="ui-label">Category</label>
                    <select id="category" name="category" required class="ui-input">
                        <option value="">Select a category</option>
                        <option value="Running" @selected(old('category', $product->category) == 'Running')>Running</option>
                        <option value="Casual" @selected(old('category', $product->category) == 'Casual')>Casual</option>
                        <option value="Formal" @selected(old('category', $product->category) == 'Formal')>Formal</option>
                        <option value="Sports" @selected(old('category', $product->category) == 'Sports')>Sports</option>
                    </select>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="price" class="ui-label">Price (PHP)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required class="ui-input">
                    </div>
                    <div>
                        <label for="stock" class="ui-label">Stock Quantity</label>
                        <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', $product->stock) }}" required class="ui-input">
                    </div>
                </div>

                <div>
                    <label for="description" class="ui-label">Description</label>
                    <textarea id="description" name="description" class="ui-input min-h-[140px]">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="ui-btn-primary">Update Product</button>
                    <a href="{{ route('admin.products.index') }}" class="ui-btn-secondary">Cancel</a>
                </div>
            </div>

            <div class="ui-card-tight h-fit">
                <p class="text-xs font-semibold uppercase tracking-[0.26em] text-amber-700">Product Image</p>
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="mt-4 h-52 w-full rounded-3xl object-cover">
                @else
                    <div class="mt-4 flex h-52 items-center justify-center rounded-3xl border border-dashed border-amber-300 bg-amber-50/70 text-sm font-semibold text-slate-500">
                        No image uploaded yet
                    </div>
                @endif
                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="ui-input mt-4">
                <p class="mt-2 text-xs text-slate-500">JPG, PNG, and WEBP supported up to 10 MB.</p>
            </div>
        </form>
    </section>
</x-admin-layout>
