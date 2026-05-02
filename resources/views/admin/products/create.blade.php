<x-admin-layout title="Create Product" subtitle="Add a new shoe listing with a clearer form and stronger upload visibility.">
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
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-[1.3fr,0.7fr]">
            @csrf

            <div class="space-y-5">
                <div>
                    <label for="name" class="ui-label">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="ui-input">
                </div>

                <div>
                    <label for="category" class="ui-label">Category</label>
                    <select id="category" name="category" required class="ui-input">
                        <option value="">Select a category</option>
                        <option value="Running" @selected(old('category') == 'Running')>Running</option>
                        <option value="Casual" @selected(old('category') == 'Casual')>Casual</option>
                        <option value="Formal" @selected(old('category') == 'Formal')>Formal</option>
                        <option value="Sports" @selected(old('category') == 'Sports')>Sports</option>
                    </select>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="price" class="ui-label">Price (PHP)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required class="ui-input">
                    </div>
                    <div>
                        <label for="stock" class="ui-label">Stock Quantity</label>
                        <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', 0) }}" required class="ui-input">
                    </div>
                </div>

                <div>
                    <label for="description" class="ui-label">Description</label>
                    <textarea id="description" name="description" class="ui-input min-h-[140px]">{{ old('description') }}</textarea>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="ui-btn-primary">Create Product</button>
                    <a href="{{ route('admin.products.index') }}" class="ui-btn-secondary">Cancel</a>
                </div>
            </div>

            <div class="ui-card-tight h-fit">
                <p class="text-xs font-semibold uppercase tracking-[0.26em] text-amber-700">Product Image</p>
                <div class="mt-4 rounded-3xl border border-dashed border-amber-300 bg-amber-50/70 p-5 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-2xl text-slate-700 shadow-sm">+</div>
                    <p class="mt-4 text-sm font-semibold text-slate-900">Upload a product image</p>
                    <p class="mt-2 text-xs text-slate-500">JPG, PNG, and WEBP supported up to 10 MB.</p>
                    <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" class="ui-input mt-4">
                </div>
            </div>
        </form>
    </section>
</x-admin-layout>
