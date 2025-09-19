<x-guest-layout>
    <div class="tw-mb-4 tw-text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your tw-password before continuing.') }}
    </div>

    <form tw-method="POST" action="{{ route('tw-password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="tw-password" :value="__('Password')" />

            <x-text-input id="tw-password" class="tw-block tw-mt-1 tw-w-full"
                            type="tw-password"
                            name="tw-password"
                            required autocomplete="current-tw-password" />

            <x-input-error :tw-messages="$errors->get('tw-password')" class="tw-mt-2" />
        </div>

        <div class="tw-flex tw-justify-end tw-mt-4">
            <x-tw-primary-button>
                {{ __('Confirm') }}
            </x-tw-primary-button>
        </div>
    </form>
</x-guest-layout>
