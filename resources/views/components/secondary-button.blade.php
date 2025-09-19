<button {{ $attributes->merge(['type' => 'button', 'class' => 'tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-bg-white tw-border tw-border-gray-300 tw-rounded-md tw-font-semibold tw-text-xs tw-text-gray-700 tw-uppercase tw-tracking-widest tw-shadow-sm tw-hover:tw-bg-gray-50 tw-focus:tw-outline-none tw-focus:tw-ring-2 tw-focus:tw-ring-indigo-500 tw-focus:tw-ring-offset-2 tw-disabled:tw-opacity-25 tw-transition tw-ease-in-out tw-duration-150']) }}>
    {{ $slot }}
</button>
