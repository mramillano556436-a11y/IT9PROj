@props(['title' => 'Admin', 'subtitle' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} | {{ config('app.name', 'ABIBAS') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="ui-page-shell min-h-screen lg:flex">
            <aside class="border-b border-neutral-300 bg-[radial-gradient(circle_at_top_left,_rgba(0,0,0,0.05),_transparent_24%),linear-gradient(180deg,#f5f5f5_0%,#fcfcfc_100%)] px-5 py-6 lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-r">
                <div class="flex items-center justify-between lg:block">
                    <div>
                        <p class="inline-flex rounded-full bg-slate-900 px-3 py-2 text-xs font-bold uppercase tracking-[0.24em] text-white">ABIBAS</p>
                        <h1 class="mt-4 text-3xl font-black tracking-[0.18em] text-slate-900">ADMIN</h1>
                        <p class="mt-3 text-sm leading-6 text-slate-600">Manage products, users, and orders with stronger labels and cleaner monochrome contrast.</p>
                    </div>
                </div>

                <nav class="mt-8 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/15' : 'text-slate-600 hover:bg-neutral-200 hover:text-slate-900' }} block rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/15' : 'text-slate-600 hover:bg-neutral-200 hover:text-slate-900' }} block rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        Products
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/15' : 'text-slate-600 hover:bg-neutral-200 hover:text-slate-900' }} block rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        Orders
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/15' : 'text-slate-600 hover:bg-neutral-200 hover:text-slate-900' }} block rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        Users
                    </a>
                </nav>
            </aside>

            <div class="flex-1 px-4 py-4 sm:px-6 lg:px-8">
                <div class="ui-surface mb-6 flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="inline-flex rounded-full bg-neutral-900 px-3 py-2 text-xs font-bold uppercase tracking-[0.24em] text-white">Admin Panel</p>
                        <h2 class="mt-3 text-2xl font-bold tracking-tight text-slate-900">{{ $title }}</h2>
                        @if($subtitle)
                            <p class="mt-1 text-sm text-slate-500">{{ $subtitle }}</p>
                        @endif
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-semibold text-slate-900">{{ auth()->user()?->name ?? 'Admin' }}</p>
                            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ auth()->user()?->role ?? 'admin' }}</p>
                        </div>
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-neutral-200 text-sm font-bold text-slate-900">
                            {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>

                <main class="space-y-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
