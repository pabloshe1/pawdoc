<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px- py- bg-[c] border- border-[BB] rounded-none font-bold text-xs text-[edb] uppercase tracking-[.em] hover:bg-[dbf] focus:bg-[dbf] active:bg-[ad] focus:outline-none focus:ring- focus:ring-[BB] focus:ring-offset- focus:ring-offset-[edb] transition ease-in-out duration- shadow-[px_px_px_ad] active:shadow-none active:translate-x-[px] active:translate-y-[px]']) }}>
    <span class="mr- italic">️</span>
    {{ $slot }}
</button>