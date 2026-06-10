@props([
    'name',
    'show' => false,
    'maxWidth' => 'xl'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    'xl' => 'sm:max-w-xl',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-\'])'
            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[] },
        lastFocusable() { return this.focusables().slice(-)[] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + ) % (this.focusables().length + ) },
        prevFocusableIndex() { return Math.max(, this.focusables().indexOf(document.activeElement)) - },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), )' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed inset- overflow-y-auto px- py- sm:px- z-"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="fixed inset- transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-"
        x-transition:enter-start="opacity-"
        x-transition:enter-end="opacity-"
        x-transition:leave="ease-in duration-"
        x-transition:leave-start="opacity-"
        x-transition:leave-end="opacity-"
    >
        <div class="absolute inset- bg-gray- opacity-"></div>
    </div>

    <div
        x-show="show"
        class="mb- bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-transition:enter="ease-out duration-"
        x-transition:enter-start="opacity- translate-y- sm:translate-y- sm:scale-"
        x-transition:enter-end="opacity- translate-y- sm:scale-"
        x-transition:leave="ease-in duration-"
        x-transition:leave-start="opacity- translate-y- sm:scale-"
        x-transition:leave-end="opacity- translate-y- sm:translate-y- sm:scale-"
    >
        {{ $slot }}
    </div>
</div>
