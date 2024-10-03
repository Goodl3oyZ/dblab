<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <div class="flex">
        <form method="post" action="{{ route('profile.update') }}" class=" mt-2 gap-6 rounded-md"
            style="display: flex; flex-direction: row; align-items: center; justify-content: start;  padding: 10px;">
            @csrf
            @method('patch')
            <!-- name -->
            <div>
                <x-input-label for="userName" :value="__('Name')" />
                <x-text-input id="userName" name="userName" type="text" class="mt-1 block w-full"
                    :value="old('userName', $user->userName)" required autofocus autocomplete="userName" />
                <x-input-error class="mt-2" :messages="$errors->get('userName')" />
            </div>
            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="userName" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif

            </div>
            <!-- save button -->
            <div class=" mt-6" style="display: flex; flex-direction: row;">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                <div class="mt-2 px-4"> @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-blue-600  dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
                </div>

            </div>

        </form>
    </div>
</section>