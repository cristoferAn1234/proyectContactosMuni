<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.asideBar')

        <!-- Contenido principal -->
        <main class="flex-1 p-8 bg-gray-100 dark:bg-gray-800">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
                {{ __('Gestión de Organizaciones') }}
            </h2>
            <p style="color: #00ADED;">Gestiona todas las organizaciones desde aquí.</p>
            
            <div class="rounded-lg border-2 border-gray-300 bg-white bg-opacity-40 shadow-inner p-4 mb-6">
                <div class="table-responsive">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-dark-200">Lista de Organizaciones</h2>
                        
                        <!-- Botón para agregar nueva organización -->
                        <button type="button" class="btn btn-primary" style="background-color: #00ADED; border-color: #00ADED;" 
                                data-bs-toggle="modal" data-bs-target="#createOrganizacionModal">
                            <i class="fas fa-plus"></i> Nueva Organización
                        </button>
                    </div>
                    
                    <!-- Tabla de organizaciones -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Cédula Jurídica</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Provincia</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($organizaciones as $organizacion)
                            <tr>
                                <td>{{ $organizacion->id }}</td>
                                <td>{{ $organizacion->ced_juridica }}</td>
                                <td>{{ $organizacion->nombre }}</td>
                                <td>{{ $organizacion->tipo->nombre ?? 'N/A' }}</td>
                                <td>{{ $organizacion->telefono }}</td>
                                <td>{{ $organizacion->correo }}</td>
                                <td>{{ $organizacion->provincia->nombre ?? 'N/A' }}</td>
                                <td>
                                    <!-- Botón Ver -->
                                    <a href="{{ route('organizaciones.show', $organizacion->id) }}" class="btn btn-info btn-sm" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <!-- Botón Editar -->
                                    <a href="{{ route('organizaciones.edit', $organizacion->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <!-- Botón Eliminar (solo admin) -->
                                    @if(auth()->user()->role === 'admin')
                                    <button type="button" class="btn btn-danger btn-sm" title="Eliminar" 
                                            onclick="openDeleteModal({{ $organizacion->id }}, '{{ $organizacion->nombre }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-500">
                                    No hay organizaciones registradas aún.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Mensajes de éxito/error -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </main>
    </div>
    
    <!-- Incluir el Modal de Crear Organización -->
    @include('organizaciones.create')
    
    <!-- Modal de Confirmación para Eliminar -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Eliminar Organización</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        ¿Estás seguro de que deseas eliminar <strong id="organizacionName"></strong>?
                        Esta acción no se puede deshacer.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="confirmDelete" 
                            class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                    <button onclick="closeDeleteModal()" 
                            class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Formulario oculto para eliminar -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    
    <script>
        let deleteOrganizacionId = null;
        
        function openDeleteModal(id, name) {
            deleteOrganizacionId = id;
            document.getElementById('organizacionName').textContent = name;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteOrganizacionId = null;
        }
        
        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (deleteOrganizacionId) {
                const form = document.getElementById('deleteForm');
                form.action = `/organizaciones/${deleteOrganizacionId}`;
                form.submit();
            }
        });
        
        // Cerrar modal al hacer clic fuera de él
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
        
        // Reabrir modal si hay errores de validación
        @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('createOrganizacionModal'));
            myModal.show();
        });
        @endif
    </script>
</x-app-layout>
