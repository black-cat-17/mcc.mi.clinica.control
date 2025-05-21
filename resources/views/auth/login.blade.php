<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="w-full max-w-md p-8 text-center">
            <h1 class="mb-4 text-3xl font-bold text-gray-800">MCC - Mi clínica control</h1>
            <h2 class="text-xl text-gray-600">Iniciar Sesión</h2>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('messages.Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('messages.Password')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{--
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('messages.Remember me') }}</span>
            </label>
        </div> --}}

        <div class="flex flex-row items-center justify-center mt-6 space-x-4">
            <a href="/registro"
                class="w-40 p-2 font-semibold text-center text-white transition duration-300 bg-gray-400 rounded hover:bg-gray-600">
                {{ __('messages.New account') }}
            </a>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <button type="submit"
                    class="w-40 p-2 font-semibold text-center text-white transition duration-300 bg-blue-600 rounded hover:bg-gray-600">
                    {{ __('messages.Log in') }}
                </button>
            </form>

            {{--
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('messages.Forgot your password?') }}
                </a>
            @endif --}}

        </div>
    </form>
</x-guest-layout>
