 <aside class="w-64 bg-white dark:bg-gray-900 h-screen shadow-md">
            <div class="p-6 text-xl font-bold" style="color: #1f2937 !important;">
                Contactos Municipales
            </div>
            <nav class="px-4">
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('dashboard') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                           <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('organizaciones.index') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                           <i class="fas fa-building"></i> Organizaciones
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contactos.index') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                            <i class="fas fa-address-book"></i> Contactos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ubicacion.index') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                            <i class="fas fa-map-marked-alt"></i> Ubicación
                        </a>
                    </li>
                    @if(Auth::user() && Auth::user()->role === 'admin')
                        <li>
                            <a href="{{ route('users.pendingApproval') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                               <i class="fas fa-users-cog"></i> Gestión de Usuarios
                            </a>
                        </li>
                         <li>
                            <a href="{{ route('users.pendingApproval') }}" class="block text-gray-700 dark:text-dark-200 hover:underline">
                                <i class="fas fa-file-alt"></i> Solicitudes 
                            </a>
                        </li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="block text-gray-700 dark:text-dark-200 hover:underline text-left w-full">
                               <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                            </button>
                        </form>
                    </a>
                    </li>
                </ul>
            </nav>
        </aside>