<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
            @include('layouts.asideBar')

        <!-- Contenido principal -->
        <main class="flex-1 p-8 bg-gray-100 dark:bg-gray-800">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
                {{ __('Bienvenido(a)') }}
            </h2>
            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-6">
                {{ __("You're logged in!") }}
            </div>
        </main>
    </div>
</x-app-layout>
