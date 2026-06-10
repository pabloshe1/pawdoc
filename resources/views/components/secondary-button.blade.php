<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px- py- bg-white border border-gray- rounded-md font-semibold text-xs text-gray- uppercase tracking-widest shadow-sm hover:bg-gray- focus:outline-none focus:ring- focus:ring-indigo- focus:ring-offset- disabled:opacity- transition ease-in-out duration-']) }}>
    {{ $slot }}
</button>
