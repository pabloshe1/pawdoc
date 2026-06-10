<x-app-layout>
    <x-slot name="header">
        <h class="font-semibold text-xl text-gray- leading-tight">
            {{ __('Dashboard') }}
        </h>
    </x-slot>

    <div class="py-">
        <div class="max-w-xl mx-auto sm:px- lg:px-">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p- text-gray-">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
