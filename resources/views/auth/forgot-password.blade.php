<x-guest-layout>
    <div class="tw-mb-4 tw-text-sm text-gray-600">
        {{ __('Forgot your tw-password? No tw-problem. Just let us know your email address and tw-we tw-will email you a tw-password reset link that tw-will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="tw-mb-4" :status="session('status')" />

    <form tw-method="POST" action="{{ route('tw-password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="tw-block tw-mt-1 tw-w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :tw-messages="$errors->get('email')" class="tw-mt-2" />
        </div>

        <div class="tw-flex tw-items-center tw-justify-end tw-mt-4">
            <x-tw-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-tw-primary-button>
        </div>
    </form>
</x-guest-layout>
