<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.asideBar')

        <!-- Contenido principal -->
        <main class="flex-1 p-8 bg-gray-100 dark:bg-gray-800">
            <div class="rounded-lg border-2 border-gray-300 bg-white bg-opacity-40 shadow-inner p-6">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-building"></i> Detalles de la Organización
                    </h2>
                    <a href="{{ route('organizaciones.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="row g-4">
                    <!-- Información Básica -->
                    <div class="col-12">
                        <h5 class="border-bottom pb-2" style="color: #00ADED;">
                            <i class="fas fa-info-circle"></i> Información Básica
                        </h5>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Cédula Jurídica:</strong>
                        <p class="mb-0">{{ $organizacion->ced_juridica }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Nombre:</strong>
                        <p class="mb-0">{{ $organizacion->nombre }}</p>
                    </div>
                    
                    <div class="col-md-12">
                        <strong class="text-muted">Tipo de Organización:</strong>
                        <p class="mb-0">{{ $organizacion->tipo->nombre ?? 'N/A' }}</p>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="col-12 mt-4">
                        <h5 class="border-bottom pb-2" style="color: #00ADED;">
                            <i class="fas fa-phone"></i> Información de Contacto
                        </h5>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Teléfono:</strong>
                        <p class="mb-0">{{ $organizacion->telefono }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Correo Electrónico:</strong>
                        <p class="mb-0">
                            <a href="mailto:{{ $organizacion->correo }}" style="color: #00ADED;">
                                {{ $organizacion->correo }}
                            </a>
                        </p>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Sitio Web:</strong>
                        <p class="mb-0">
                            @if($organizacion->urlPageWeb)
                                <a href="{{ $organizacion->urlPageWeb }}" target="_blank" style="color: #00ADED;">
                                    {{ $organizacion->urlPageWeb }}
                                </a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Directorio Telefónico:</strong>
                        <p class="mb-0">
                            @if($organizacion->urlDirectorioTelefonico)
                                <a href="{{ $organizacion->urlDirectorioTelefonico }}" target="_blank" style="color: #00ADED;">
                                    Ver directorio
                                </a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                    <!-- Ubicación -->
                    <div class="col-12 mt-4">
                        <h5 class="border-bottom pb-2" style="color: #00ADED;">
                            <i class="fas fa-map-marker-alt"></i> Ubicación
                        </h5>
                    </div>
                    
                    <div class="col-md-4">
                        <strong class="text-muted">Provincia:</strong>
                        <p class="mb-0">{{ $organizacion->provincia->nombre ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-4">
                        <strong class="text-muted">Cantón:</strong>
                        <p class="mb-0">{{ $organizacion->canton->nombre ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-4">
                        <strong class="text-muted">Distrito:</strong>
                        <p class="mb-0">{{ $organizacion->distrito->nombre ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Coordenadas:</strong>
                        <p class="mb-0">
                            @if($organizacion->ubi_lat && $organizacion->ubi_long)
                                Lat: {{ $organizacion->ubi_lat }}, Long: {{ $organizacion->ubi_long }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>

                    <!-- Información de Auditoría -->
                    <div class="col-12 mt-4">
                        <h5 class="border-bottom pb-2" style="color: #00ADED;">
                            <i class="fas fa-history"></i> Información de Auditoría
                        </h5>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Creado por:</strong>
                        <p class="mb-0">{{ $organizacion->user->name ?? 'N/A' }}</p>
                        <small class="text-muted">{{ $organizacion->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Última actualización:</strong>
                        <p class="mb-0">{{ $organizacion->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-12 mt-4 d-flex gap-2">
                        <a href="{{ route('organizaciones.edit', $organizacion->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        
                        @if(auth()->user()->role === 'admin')
                        <button type="button" class="btn btn-danger" 
                                onclick="openDeleteModal({{ $organizacion->id }}, '{{ $organizacion->nombre }}')">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
    
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
    </script>
</x-app-layout>
