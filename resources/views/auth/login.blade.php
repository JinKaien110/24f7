<x-guest-layout >
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Text Content for Log in -->
        <header class="flex flex-col text-start mb-10">
            <h1 class="font-medium text-3xl pt-10 whitespace-nowrap mb-10">Customer Sign In</h1>
            <h2 class="font-medium text-base pt-2 whitespace-nowrap">Registered Customers</h2>
            <h3 class="font-light text-sm pt-2 whitespace-nowrap">If you have an account, sign in with your email address.</h3>
        </header>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block     mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded focus:outline-none focus:ring-0 border-black text-[#3c88f8]" name="remember">
                <span class="ms-2 text-sm text-black">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="hover:underline text-sm text-black" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="space-y-5 mt-5">
        <section class="space-y-2 w-full">
            <h1 class="font-medium">New Customers</h1>
            <p class="font-light text-sm">Creating an account has many benefits: check out faster,
            keep more than one address, and more.</p>
        </section>
        <div class="text-end">
        <a href="{{ route('register') }}"
                    class="bg-[#3c88f8] hover:bg-[#254B9D] text-white px-[35px] py-3 rounded-md">
                    {{ __('Create an account') }}
        </a>
        </div>
        </div>
    </form>
</x-guest-layout>
