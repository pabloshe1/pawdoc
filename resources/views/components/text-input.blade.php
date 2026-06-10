@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-[dca]/ border- border-[c]/ focus:border-[BB] focus:ring-[BB] rounded-none text-[dbf] shadow-inner font-serif placeholder-[c]/']) !!}>