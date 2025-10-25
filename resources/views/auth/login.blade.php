<title>Login</title>
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Auto-redirect with history management -->
    <script>
        (function () {
            'use strict';

            let redirectAttempted = false;

            function checkAndRedirect() {
                if (redirectAttempted) return;

                fetch('{{ route("check-session") }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials: 'same-origin',
                    cache: 'no-store'
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Network error');
                        return response.json();
                    })
                    .then(data => {
                        if (data.loggedIn && data.redirectUrl && !redirectAttempted) {
                            redirectAttempted = true;

                            // Replace current history entry completely
                            if (window.history.replaceState) {
                                window.history.replaceState(null, '', data.redirectUrl);
                            }

                            // Use replace to remove login from history
                            window.location.replace(data.redirectUrl);
                        }
                    })
                    .catch(() => {
                        // Silent failure
                    });
            }

            // Check immediately
            checkAndRedirect();

            // Check again after a short delay
            setTimeout(checkAndRedirect, 100);

            // Additional check when page becomes visible
            document.addEventListener('visibilitychange', function () {
                if (!document.hidden) {
                    setTimeout(checkAndRedirect, 50);
                }
            });

            // Prevent any form submission if redirect is pending
            document.addEventListener('submit', function (e) {
                if (redirectAttempted) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                }
            }, true);

        })();
    </script>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="user_ID" :value="__('Username')" />
            <label for="user_ID" class="text-sm italic text-primary">(sent to your provided email)</label>
            <x-text-input id="user_ID" class="block mt-1 w-full text-[15px] max-sm:text-sm h-[35px]" type="text"
                name="user_ID" :value="old('user_ID')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('user_ID')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="user_Password" :value="__('Password')" />
            <label for="user_Password" class="text-sm italic text-primary">(your password)</label>
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

        <!-- Sign Up Link -->
        <div class="flex justify-center items-center mt-4">
            <a href="{{ route('register') }}" class="max-md:text-sm flex gap-x-1 text-primary hover:text-secondary duration-200">
                <p>Don't have an account?</p>
                <p>Sign up</p>
            </a>
        </div>
    </form>
</x-guest-layout>