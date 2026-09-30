<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <header class="space-y-5 mt-5 mb-10">
            <h1 class="font-medium text-2xl">Create New Customer Account</h1>
            <h2 class="font-light text-sm">Create new account today to reap the benefits of a personalized shopping experience.</h2>        
        </header>

        <!-- Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="family-name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms and Condition -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="terms_condition" type="checkbox" class="rounded focus:outline-none focus:ring-0 border-black text-[#3c88f8]" name="termscondition">
                <span class="ms-2 text-sm text-black hover:text-[#3c88f8] hover:underline">{{ __('Terms & Condition') }}</span>
            </label>
        </div>

        <!-- Hala may tipaklong -->
        <div class="flex items-center justify-between mt-4">
            <a class="hover:underline text-sm ml-3" href="{{ route('login') }}">
                {{ __('Already a customer?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
