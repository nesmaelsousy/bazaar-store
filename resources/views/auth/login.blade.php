<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-4">
        @csrf
        <p class="statusMessage hidden mb-4 text-center font-medium"></p>
        <!-- username  -->
        <div class="text-left">
            <x-input-label for="email" :value="__('User Email')" />
            <x-text-input id="email" name="email" type="email" placeholder="Enter Your Email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <!-- Password -->
        <div class="password-wrapper relative text-left">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" name="password" placeholder="Enter Your Password" class="password-field"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <i class="fa-solid fa-eye togglePassword hidden absolute right-3 top-10 cursor-pointer text-[#835837]"></i>
            <p class="error-msg text-sm mt-1 hidden"></p>
        </div>

        <div class="flex items-center justify-between">
            <div class="block mt-4 text-left">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-[#e5d3c5] text-[#835837] focus:ring-2 focus:ring-[#c8a98d]" name="remember">
                    <span class="ms-2 text-sm text-[#835837]">{{ __('Remember me') }}</span>
                </label>
            </div>
            @if (Route::has('password.request'))
            <a id="goToForgot" class="text-sm text-left text-[#9A7F73] cursor-pointer underline hover:text-[#835837]" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div>
        <x-primary-button class="ms-3">
            {{ __('Log in') }}
        </x-primary-button>
    </form>
</x-guest-layout>