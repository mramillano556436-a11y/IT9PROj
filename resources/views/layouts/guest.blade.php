<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="ui-page-shell flex min-h-screen items-center justify-center px-4 py-10">
            <div class="grid w-full max-w-6xl overflow-hidden rounded-[2rem] border border-amber-200 bg-white/90 shadow-[0_30px_90px_rgba(20,33,61,0.18)] lg:grid-cols-[1fr,0.92fr]">
                <div class="hidden bg-[radial-gradient(circle_at_top_left,_rgba(255,211,109,0.34),_transparent_30%),linear-gradient(145deg,#16213e_0%,#203354_55%,#34538a_100%)] p-12 text-white lg:flex lg:flex-col lg:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-amber-200">ABIBAS Storefront</p>
                        <h1 class="mt-6 max-w-md text-5xl font-black leading-tight">Step into a sharper shopping experience.</h1>
                        <p class="mt-6 max-w-md text-base leading-7 text-slate-200">
                            Sign in to manage orders, explore new releases, and access a cleaner dashboard built for faster browsing.
                        </p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-amber-200">Fast</p>
                            <p class="mt-2 text-sm text-slate-100">Quick access to your cart and orders.</p>
                        </div>
                        <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-amber-200">Clear</p>
                            <p class="mt-2 text-sm text-slate-100">High-contrast actions and readable labels.</p>
                        </div>
                        <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-amber-200">Focused</p>
                            <p class="mt-2 text-sm text-slate-100">A storefront designed around product browsing.</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-8 sm:px-10 lg:px-12 lg:py-12">
                    <div class="mb-8 text-center lg:hidden">
                        <a href="/">
                            <x-application-logo class="mx-auto h-16 w-16 fill-current text-slate-900" />
                        </a>
                        <p class="mt-4 text-xs font-semibold uppercase tracking-[0.35em] text-amber-700">ABIBAS Storefront</p>
                    </div>

                    <div class="mx-auto max-w-md">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
