@props([
    'name',
    'show' => false,
    'maxWidth' => 'tw-2xl'
])

@php
$maxWidth = [
    'tw-sm' => 'tw-sm:tw-max-w-sm',
    'tw-md' => 'tw-sm:tw-max-w-md',
    'tw-lg' => 'tw-sm:tw-max-w-lg',
    'tw-xl' => 'tw-sm:tw-max-w-xl',
    'tw-2xl' => 'tw-sm:tw-max-w-2xl',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'tw-hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.tw-max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$tw-watch('show', value => {
        if (value) {
            document.body.classList.add('tw-overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('tw-overflow-y-hidden');
        }
    })"
    x-on:open-tw-modal.tw-window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-tw-modal.tw-window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.tw-window="show = false"
    x-on:keydown.tab.tw-prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.tw-prevent="prevFocusable().focus()"
    x-show="show"
    class="tw-fixed tw-inset-0 tw-overflow-y-auto tw-px-4 tw-py-6 sm:tw-px-0 tw-z-50"
    style="display: {{ $show ? 'tw-block' : 'none' }};"
>
    <div
        x-show="show"
        class="tw-fixed tw-inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="tw-absolute tw-inset-0 tw-bg-gray-500 opacity-75"></div>
    </div>

    <div
        x-show="show"
        class="tw-mb-6 tw-bg-white tw-rounded-lg tw-overflow-hidden tw-shadow-xl transform transition-all sm:tw-w-full {{ $maxWidth }} sm:tw-mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 tw-translate-y-4 sm:tw-translate-y-0 sm:tw-scale-95"
        x-transition:enter-end="opacity-100 tw-translate-y-0 sm:tw-scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 tw-translate-y-0 sm:tw-scale-100"
        x-transition:leave-end="opacity-0 tw-translate-y-4 sm:tw-translate-y-0 sm:tw-scale-95"
    >
        {{ $slot }}
    </div>
</div>
