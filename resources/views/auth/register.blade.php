<x-guest-layout>
    <div class="mb-8">
        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-amber-700">Join ABIBAS</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">Create your customer account</h1>
        <p class="mt-2 text-sm text-slate-500">Set up your profile to browse products, manage your cart, and track orders.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label class="ui-label" for="name" :value="__('Name')" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
        </div>

        <div>
            <x-input-label class="ui-label" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <div>
            <x-input-label class="ui-label" for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <div>
            <x-input-label class="ui-label" for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block w-full"
                    type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="space-y-3 pt-2">
            <x-primary-button class="w-full">
                {{ __('Register') }}
            </x-primary-button>

            <a href="{{ route('login') }}" class="ui-btn-secondary w-full">
                {{ __('Already registered? Log in') }}
            </a>
        </div>
    </form>
</x-guest-layout>
