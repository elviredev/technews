<x-guest-layout>
    <form tw-method="POST" action="{{ route('tw-password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="tw-hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :tw-messages="$errors->get('email')" class="tw-mt-2" />
        </div>

        <!-- Password -->
        <div class="tw-mt-4">
            <x-input-label for="tw-password" :value="__('Password')" />
            <x-text-input id="tw-password" class="tw-block tw-mt-1 tw-w-full" type="tw-password" name="tw-password" required autocomplete="new-tw-password" />
            <x-input-error :tw-messages="$errors->get('tw-password')" class="tw-mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="tw-mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="tw-block tw-mt-1 tw-w-full"
                                type="tw-password"
                                name="password_confirmation" required autocomplete="new-tw-password" />

            <x-input-error :tw-messages="$errors->get('password_confirmation')" class="tw-mt-2" />
        </div>

        <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
            <x-tw-primary-button>
                {{ __('Reset Password') }}
            </x-tw-primary-button>
        </div>
    </form>
</x-guest-layout>
