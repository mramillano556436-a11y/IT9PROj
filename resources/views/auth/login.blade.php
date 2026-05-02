<x-guest-layout>
    <div class="mb-8">
        <div class="inline-flex rounded-full bg-amber-100 px-4 py-2 text-xs font-bold uppercase tracking-[0.28em] text-amber-900">Welcome Back</div>
        <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900">Sign in to your account</h1>
        <p class="mt-3 text-sm leading-6 text-slate-600">Access your orders, cart, and admin tools with a clearer, faster workspace.</p>
    </div>

    <x-auth-session-status class="mb-4 ui-alert-success" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label class="ui-label rounded-xl bg-slate-900 px-3 py-2 text-white" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label class="ui-label rounded-xl bg-slate-900 px-3 py-2 text-white" for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="rounded-full bg-amber-100 px-3 py-2 text-xs font-semibold text-amber-900 transition hover:bg-amber-200" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <label for="remember_me" class="flex items-center gap-3 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm font-medium text-slate-700">
            <input id="remember_me" type="checkbox" class="rounded border-amber-300 text-slate-900 focus:ring-amber-400" name="remember">
            <span>{{ __('Remember me on this device') }}</span>
        </label>

        <div class="space-y-3">
            <x-primary-button class="w-full">
                {{ __('Log in') }}
            </x-primary-button>

            <a href="{{ route('register') }}" class="ui-btn-secondary w-full">
                {{ __('Create a new account') }}
            </a>
        </div>
    </form>
</x-guest-layout>
