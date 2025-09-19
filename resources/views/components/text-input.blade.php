@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:tw-ring-indigo-500 tw-rounded-md tw-shadow-sm']) }}>
