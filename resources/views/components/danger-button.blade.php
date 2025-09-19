<button {{ $attributes->merge(['type' => 'submit', 'class' => 'tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-bg-red-600 border border-transparent tw-rounded-md tw-font-semibold tw-text-xs text-tw-white uppercase tw-tracking-widest tw-hover:tw-bg-red-500 active:tw-bg-red-700 focus:outline-none focus:tw-ring-2 focus:tw-ring-red-500 focus:tw-ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
