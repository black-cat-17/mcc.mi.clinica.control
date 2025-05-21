<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="w-full max-w-md p-8 text-center">
            <h1 class="mb-4 text-3xl font-bold text-gray-800">MCC - Mi clínica control</h1>
            <h2 class="text-xl text-gray-600">Nuevo Registro</h2>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="nombre" :value="__('messages.Name')" />
            <x-text-input id="nombre" class="block w-full mt-1" type="text" name="nombre" :value="old('nombre')" required
                autofocus autocomplete="nombre" />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- apellidos -->
        <div>
            <x-input-label for="apellidos" :value="__('Apellidos')" />
            <x-text-input id="apellidos" class="block w-full mt-1" type="text" name="apellidos" :value="old('apellidos')"
                required autofocus autocomplete="apellidos" />
            <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
        </div>

        <!-- apellidos -->
        <div>
            <x-input-label for="telefono" :value="__('Teléfono')" />
            <x-text-input id="telefono" class="block w-full mt-1" type="text" name="telefono" :value="old('telefono')"
                required autofocus autocomplete="telefono" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('messages.Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('messages.Password')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('messages.Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Tipo de Usuario -->
        <div class="mt-4 d-flex align-items-center">
            <label for="tipo_user" class="form-label me-3">{{ __('messages.User Type') }}</label>
            <select name="tipo_user" id="tipo_user" class="w-auto form-select" required>
                <option value="paciente">Paciente</option>
                <option value="facultativo">Facultativo</option>
                {{-- <option value="admin">Administrador</option> --}}
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('messages.Already registered?') }}
            </a>

            <x-primary-button class="bg-gray-600 ms-4 ">
                {{ __('messages.Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
