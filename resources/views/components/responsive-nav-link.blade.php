@props(['active'])

@php
$classes = ($active ?? false)
            ? 'tw-block tw-w-full tw-ps-3 tw-pe-4 tw-py-2 border-l-4 border-indigo-400 text-start tw-text-base tw-font-medium text-indigo-700 tw-bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:tw-bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'tw-block tw-w-full tw-ps-3 tw-pe-4 tw-py-2 border-l-4 border-transparent text-start tw-text-base tw-font-medium text-gray-600 tw-hover:text-gray-800 tw-hover:tw-bg-gray-50 tw-hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:tw-bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
