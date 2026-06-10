<x-guest-layout>
    <div class="mb- text-sm text-gray-">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb- font-medium text-sm text-green-">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt- flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray- hover:text-gray- rounded-md focus:outline-none focus:ring- focus:ring-offset- focus:ring-indigo-">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
