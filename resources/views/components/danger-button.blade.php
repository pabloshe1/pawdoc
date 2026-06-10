<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px- py- bg-red- border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red- active:bg-red- focus:outline-none focus:ring- focus:ring-red- focus:ring-offset- transition ease-in-out duration-']) }}>
    {{ $slot }}
</button>
