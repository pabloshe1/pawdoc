<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300" name="remember">
                <span class="ms-2 text-sm" style="color:#5c4033;font-family:'Chakra Petch',sans-serif;font-size:11px;">Ingat Saya</span>
            </label>
        </div>
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color:#5c4033;font-size:11px;text-decoration:underline;font-family:'Chakra Petch',sans-serif;">Lupa Kata Sandi?</a>
            @endif
            <x-primary-button class="ms-3">Masuk</x-primary-button>
        </div>
    </form>
</x-guest-layout>
