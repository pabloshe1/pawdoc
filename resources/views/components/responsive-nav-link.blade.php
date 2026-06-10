@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps- pe- py- border-l- border-indigo- text-start text-base font-medium text-indigo- bg-indigo- focus:outline-none focus:text-indigo- focus:bg-indigo- focus:border-indigo- transition duration- ease-in-out'
            : 'block w-full ps- pe- py- border-l- border-transparent text-start text-base font-medium text-gray- hover:text-gray- hover:bg-gray- hover:border-gray- focus:outline-none focus:text-gray- focus:bg-gray- focus:border-gray- transition duration- ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
