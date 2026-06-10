@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px- pt- border-b- border-indigo- text-sm font-medium leading- text-gray- focus:outline-none focus:border-indigo- transition duration- ease-in-out'
            : 'inline-flex items-center px- pt- border-b- border-transparent text-sm font-medium leading- text-gray- hover:text-gray- hover:border-gray- focus:outline-none focus:text-gray- focus:border-gray- transition duration- ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
