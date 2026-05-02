<nav x-data="{ open: false }" class="px-4 pt-4 sm:px-6 lg:px-8">
    <div class="ui-surface mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex items-center gap-6">
                <div class="shrink-0">
                    <a href="{{ route('shop.index') }}" class="text-xl font-black tracking-[0.24em] text-slate-900">
                        ABIBAS
                    </a>
                </div>

                <div class="hidden items-center gap-2 sm:flex">
                    <x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                        {{ __('Shop') }}
                    </x-nav-link>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Admin Dashboard') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')">
                                {{ __('My Account') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden items-center gap-3 sm:flex">
                @auth
                    <a href="{{ route('shop.cart') }}" class="relative inline-flex items-center rounded-full bg-amber-100 px-4 py-2 text-sm font-semibold text-slate-800 transition hover:bg-amber-200">
                        Cart
                        @php
                            $cartCount = count(session('cart', []));
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-slate-900 text-xs text-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                @endauth

                @if(Auth::check())
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center rounded-full border border-amber-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-amber-300 hover:bg-amber-50 hover:text-slate-900 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-2">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="space-y-1 p-1">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if(Auth::user()->role === 'admin')
                                    <x-dropdown-link :href="route('admin.dashboard')">
                                        {{ __('Admin Panel') }}
                                    </x-dropdown-link>
                                @endif

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="ui-link">Login</a>
                    <a href="{{ route('register') }}" class="ui-btn-accent px-4 py-2 text-sm">Register</a>
                @endif
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-xl bg-amber-100 p-2 text-slate-700 transition hover:bg-amber-200 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-amber-100 py-4 sm:hidden">
            <div class="space-y-2">
                <x-responsive-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                    {{ __('Shop') }}
                </x-responsive-nav-link>

                @auth
                    @if(Auth::user()->role === 'admin')
                        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Admin Dashboard') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('customer.dashboard')" :active="request()->routeIs('customer.dashboard')">
                            {{ __('My Account') }}
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link :href="route('shop.cart')">
                        {{ __('Cart') }}
                    </x-responsive-nav-link>
                @endauth
            </div>

            @auth
                <div class="mt-4 border-t border-amber-100 pt-4">
                    <div class="px-4">
                        <div class="text-base font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-slate-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-2">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @else
                <div class="mt-4 border-t border-amber-100 pt-4">
                    <div class="space-y-2">
                        <x-responsive-nav-link :href="route('login')">
                            {{ __('Login') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
