<x-guest-layout  >
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 " :status="session('status')" />

    <h2 class="py-4 text-2xl font-normal text-center text-gray-300 mb-3">{{ __('Log in') }}</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label class="mb-2 " for="email" :value="__('Email')" />
            <x-text-input id="email" placeholder="Enter your email"
                class="block mt-1 w-full border rounded-md shadow-sm focus:ring focus:ring-indigo-300" type="email"
                name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label class="mb-2"  for="password" :value="__('Password')" />
            <x-text-input id="password" placeholder="Enter your password"
                class="block mt-1 w-full border rounded-md shadow-sm focus:ring focus:ring-indigo-300" type="password"
                name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
            <a class="text-sm text-indigo-600 hover:text-indigo-400" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- ข้อความแนะนำให้ไปสมัคร -->
    <div class="mt-4 pb-4 text-center">
        <p class="text-sm text-gray-600">
            {{ __('Don\'t have an account?') }}
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-400">
                {{ __('Register here') }}
            </a>
        </p>
    </div>
</x-guest-layout>
