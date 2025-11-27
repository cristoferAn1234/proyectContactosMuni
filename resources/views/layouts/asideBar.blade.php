 <aside class="w-64 bg-white dark:bg-gray-900 h-screen shadow-md">
            <div class="p-6 text-xl font-bold text-gray-900 dark:text-white">
                Contactos Municipales
            </div>
            <nav class="px-4">
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('dashboard') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('organizaciones.index') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                            Organizaciones
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contactos.index') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                            Contactos
                        </a>
                    </li>
                    @if(Auth::user() && Auth::user()->role === 'admin')
                        <li>
                            <a href="{{ route('userTcu.gestionUsuarios') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">

                                Gestión de Usuarios
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('users.getAll') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                                Solicitudes 
                            </a>
                        </li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="block text-gray-700 dark:text-dark-200 hover:underline text-left w-full">
                                Cerrar Sesión
                            </button>
                        </form>
                    </a>
                    </li>
                </ul>
            </nav>
        </aside>