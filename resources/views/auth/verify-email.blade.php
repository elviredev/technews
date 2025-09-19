<x-guest-layout>
    <div class="tw-mb-4 tw-text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link tw-we just emailed to you? If you didn\'t receive the email, tw-we tw-will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="tw-mb-4 tw-font-medium tw-text-sm text-green-600">
            {{ __('A new verification link tw-has been sent to the email address you tw-provided during registration.') }}
        </div>
    @endif

    <div class="tw-mt-4 tw-flex tw-items-center tw-justify-between">
        <form tw-method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-tw-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-tw-primary-button>
            </div>
        </form>

        <form tw-method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline tw-text-sm text-gray-600 tw-hover:text-gray-900 tw-rounded-md focus:outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
