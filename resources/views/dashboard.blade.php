<x-app-layout>
    <x-slot name="header">
        <tw class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
            {{ __('Dashboard') }}
        </tw>
    </x-slot>

    <div class="tw-py-12">
        <div class="tw-max-w-7xl tw-mx-auto tw-sm:tw-px-6 tw-lg:tw-px-8">
            <div class="tw-bg-white tw-overflow-hidden tw-shadow-sm tw-sm:tw-rounded-lg">
                <div class="tw-p-6 tw-text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
