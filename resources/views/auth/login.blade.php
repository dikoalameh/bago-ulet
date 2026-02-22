<title>Login</title>
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Lightweight session check -->
    <script>
        (function () {
            'use strict';

            // Immediate redirect without visible loading
            fetch('{{ route("check-session") }}', {
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin'
            })
                .then(response => response.ok ? response.json() : Promise.reject())
                .then(data => {
                    if (data.loggedIn && data.redirectUrl) {
                        // Immediate redirect without delay
                        window.location.href = data.redirectUrl;
                    }
                })
                .catch(() => { });
        })();
    </script>

    <form method="POST" action="{{ route('login') }}">
        <div class="flex items-center justify-center">
            <!-- DTO UNG LOGO KAYA HNDI NAKA CENTERALIZED BY Y-AXIS -->
            <x-application-logo class="w-8 text-gray-500" />
        </div>
        <div class="flex items-center justify-center font-bold text-2xl max-sm:text-xl mt-4 text-primary">
            MCURRS
        </div>
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="user_ID" :value="__('Username')" />
            <x-text-input id="user_ID" class="block mt-1 w-full text-[15px] max-sm:text-sm h-[35px]" type="text"
                name="user_ID" :value="old('user_ID')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('user_ID')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="user_Password" :value="__('Password')" />
            <x-text-input id="user_Password" class="block mt-1 w-full text-[15px] max-sm:text-sm h-[35px]"
                type="password" name="user_Password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('user_Password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="mt-4">
            <div class="flex items-center justify-between text-gray-500">
                <label for="remember_me" class="flex items-center space-x-1">
                    <input id="remember_me" type="checkbox" class="rounded max-sm:w-[14px] max-sm:h-[14px]"
                        name="remember" />
                    <span class="max-md:text-sm text-primary">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}"
                    class="max-md:text-sm text-primary hover:text-secondary duration-200">
                    Forgot password?
                </a>
            </div>
        </div>

        <!-- Login Button -->
        <div class="flex mt-4">
            <x-primary-button class="justify-center items-center max-md:text-sm w-full">
                {{ __('Login') }}
            </x-primary-button>
        </div>

        <div
            class="relative flex items-center justify-center my-6 gap-4 before:content-[''] before:flex-1 before:h-px before:bg-primary after:content-[''] after:flex-1 after:h-px after:bg-primary">
            <span class="text-primary text-sm whitespace-nowrap">
                or continue with
            </span>
        </div>

        <div class="flex mt-4 w-full bg-primary hover:bg-darkpurple transition-all duration-300 rounded-lg">
            <a href="" class="w-full flex items-center justify-center text-white gap-x-2 px-2 py-2">
                <i class="bi bi-microsoft-teams text-lg"></i>
                <span>
                    Microsoft Teams
                </span>
            </a>
        </div>

        <!-- Sign Up Link -->
        <div class="flex justify-center items-center mt-4">
            <a href="{{ route('register') }}"
                class="max-md:text-sm flex gap-x-1 text-primary hover:text-secondary duration-200">
                <p>Don't have an account?</p>
                <p>Sign up</p>
            </a>
        </div>
    </form>
</x-guest-layout>