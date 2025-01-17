
<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

 <div>

        @include('partials.langouge')

        </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
       
        <br>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('public.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('public.password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('public.remember_me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
    <a class="forgot-password-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
        {{ __('public.forgot_password') }}
    </a>
@endif

<a class="register-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
    {{ __('public.register') }}
</a>
<style>
    .forgot-password-link {
        margin-right: 20px; 
        margin-left: 20px; 
    }
</style>

            <x-primary-button class="ms-3">
                {{ __('public.login') }}
            </x-primary-button>
            
        </div>
    </form>
</x-guest-layout>
