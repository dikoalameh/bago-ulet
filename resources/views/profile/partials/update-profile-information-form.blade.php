<section>
    <header>
        <h2 class="text-lg font-medium text-primary">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 max-xl:text-sm block w-full" autofocus
                autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 max-xl:text-sm block w-full"
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            <div>
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification"
                        class="underline text-sm text-primary hover:text-orangeyellow duration-200 rounded-md">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        </div>

        <div>
            <x-input-label for="profile_photo" :value="__('Profile Picture')" />
            <!-- Profile container -->
            <div class="user-img relative w-[130px] max-md:w-[115px] h-[130px] max-md:h-[115px]">
                <!-- Profile image -->
                <img src="{{ asset('images/mcu-logo.png') }}" id="photo" alt="profile"
                    class="w-[130px] max-md:w-[115px] h-[130px] max-md:h-[115px] rounded-full border-2 border-white shadow-md" />

                <!-- Hidden file input -->
                <input type="file" id="file" class="hidden" />

                <!-- Upload button -->
                <label for="file" id="uploadBtn"
                    class="absolute bottom-0 right-0 flex items-center justify-center w-[32px] max-md:w-[28px] max-md:h-[28px] h-[32px] rounded-full bg-darkgray text-white shadow-[2px_4px_4px_rgba(0,0,0,0.6)] cursor-pointer hover:bg-primary transition">
                    <i class="bi bi-camera-fill max-md:text-sm"></i>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
<script>
    const imgDiv = document.querySelector('.user-img');
    const img = document.querySelector('#photo');
    const file = document.querySelector('#file');
    const uploadBtn = document.querySelector('#uploadBtn');

    file.addEventListener('change', function () {
        const chosenFile = this.files[0];
        if (chosenFile) {
            const reader = new FileReader();

            reader.addEventListener('load', function () {
                img.setAttribute('src', reader.result);
            })
            reader.readAsDataURL(chosenFile);
        }
    })
</script>