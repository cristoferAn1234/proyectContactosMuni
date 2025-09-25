<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-900 h-screen shadow-md">
            <div class="p-6 text-xl font-bold text-gray-900 dark:text-white">
                Contactos Municipales
            </div>
            <nav class="px-4">
                <ul class="space-y-4">
                    <li>
                        <a href="" class="block text-gray-700 dark:text-gray-200 hover:underline">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="" class="block text-gray-700 dark:text-gray-200 hover:underline">
                            Organizaciones
                        </a>
                    </li>
                    <li>
                        <a href="" class="block text-gray-700 dark:text-gray-200 hover:underline">
                            Contactos
                        </a>
                    </li>
                    @if(Auth::user() && Auth::user()->role === 'admin')
                        <li>
                            <a href="" class="block text-gray-700 dark:text-gray-200 hover:underline">
                                Gestión de Usuarios
                            </a>
                        </li>
                         <li>
                            <a href="" class="block text-gray-700 dark:text-gray-200 hover:underline">
                                Asignación de Organizaciones
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="" class="block text-gray-700 dark:text-gray-200 hover:underline">
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

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
