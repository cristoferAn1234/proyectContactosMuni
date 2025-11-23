 <aside class="w-64 bg-white dark:bg-gray-900 h-screen shadow-md">
            <div class="p-6 text-xl font-bold text-gray-900 dark:text-white">
                Contactos Municipales
            </div>
            <nav class="px-4">
                <ul class="space-y-4">
                    <li>
                        <a href="" class="block text-gray-700 dark:text-dark-200 hover:underline">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="" class="block text-gray-700 dark:text-dark-200 hover:underline">
                            Organizaciones
                        </a>
                    </li>
                    <li>
                        <a href="" class="block text-gray-700 dark:text-dark-200 hover:underline">
                            Contactos
                        </a>
                    </li>
                    @if(Auth::user() && Auth::user()->role === 'admin')
                        <li>
                            <a href="" class="block text-gray-700 dark:text-dark-200 hover:underline">
                                Gestión de Usuarios
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('users.pendingApproval') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                                Solicitudes 
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="" class="block text-gray-700 dark:text-dark-200 hover:underline">
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>