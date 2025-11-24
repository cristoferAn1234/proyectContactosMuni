<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <!-- Título -->
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ __('Iniciar sesión') }}</h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Accede a tu cuenta') }}</p>
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Correo electrónico') }}
            </label>
            <x-text-input id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
                placeholder="usuario@ejemplo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Contraseña') }}
            </label>
            <x-text-input id="password" 
                class="block mt-1 w-full"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me y Forgot Password -->
        <div class="block mt-4 flex justify-between items-center">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" 
                    type="checkbox" 
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" 
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuérdame') }}</span>
            </label>
            
            @if (Route::has('password.request'))
            <a class="text-sm hover:underline" 
               style="color: #00ADED;"
               href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
            </a>
            @endif
        </div>

        <!-- Botón de Login -->
        <div class="mt-6">
            <x-primary-button class="w-full h-12 justify-center text-white !rounded-lg shadow-lg hover:shadow-xl transition-all duration-200" 
                style="background: linear-gradient(to right, #00ADED, #0088cc);">
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>
        
        <!-- Registro -->
        <div class="mt-6 text-center border-t pt-4">
            <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('¿No tienes cuenta?') }} </span>
            @if (Route::has('register'))
            <a class="text-sm font-medium hover:underline" 
               style="color: #00ADED;"
               href="{{ route('register') }}">
                {{ __('Regístrate aquí') }}
            </a>
            @endif
        </div>
    </form>
</x-guest-layout>