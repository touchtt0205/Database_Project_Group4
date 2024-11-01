<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2 class="py-4 text-2xl font-normal text-center text-gray-300 mb-3">{{ __('Register') }}</h2>

        <!-- Name -->
        <div>
            <x-input-label class="mb-2 " for="name" :value="__('Name')" />
            <x-text-input placeholder="Enter your name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label class="mb-2 " for="email" :value="__('Email')" />
            <x-text-input placeholder="Enter your email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label class="mb-2 " for="password" :value="__('Password')" />

            <x-text-input placeholder="Enter your password" id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label class="mb-2 " for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input placeholder="Confirm your password" id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    <!-- ข้อความแนะนำให้ไปสมัคร -->
    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">
            {{ __('join website !') }}
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-900">
                {{ __('Login') }}
            </a>
        </p>
    </div>
</x-guest-layout>
