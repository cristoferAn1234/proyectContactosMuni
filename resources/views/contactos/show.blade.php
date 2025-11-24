<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.asideBar')

        <!-- Contenido principal -->
        <main class="flex-1 p-8 bg-gray-100 dark:bg-gray-800">
            <div class="rounded-lg border-2 border-gray-300 bg-white bg-opacity-40 shadow-inner p-6">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-user"></i> Detalles del Contacto
                    </h2>
                    <a href="{{ route('contactos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="row g-4">
                    <!-- Información Personal -->
                    <div class="col-12">
                        <h5 class="border-bottom pb-2" style="color: #00ADED;">
                            <i class="fas fa-user"></i> Información Personal
                        </h5>
                    </div>
                    
                    <div class="col-md-4">
                        <strong class="text-muted">Nombre Completo:</strong>
                        <p class="mb-0">{{ $contacto->nombre }} {{ $contacto->apellido1 }} {{ $contacto->apellido2 }}</p>
                    </div>
                    
                    <div class="col-md-4">
                        <strong class="text-muted">Sexo:</strong>
                        <p class="mb-0">{{ $contacto->sexo }}</p>
                    </div>
                    
                    <div class="col-md-4">
                        <strong class="text-muted">Formación Académica:</strong>
                        <p class="mb-0">{{ $contacto->formacion }}</p>
                    </div>

                    <!-- Información Laboral -->
                    <div class="col-12 mt-4">
                        <h5 class="border-bottom pb-2" style="color: #00ADED;">
                            <i class="fas fa-briefcase"></i> Información Laboral
                        </h5>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Organización:</strong>
                        <p class="mb-0">{{ $contacto->organizacion->nombre ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Departamento:</strong>
                        <p class="mb-0">{{ $contacto->departamento }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Puesto:</strong>
                        <p class="mb-0">{{ $contacto->puesto }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Extensión:</strong>
                        <p class="mb-0">{{ $contacto->extension ?? 'N/A' }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Nivel de Contacto:</strong>
                        <p class="mb-0">
                            @if($contacto->nivel_contacto == 'Alto')
                                <span class="badge bg-danger">{{ $contacto->nivel_contacto }}</span>
                            @elseif($contacto->nivel_contacto == 'Medio')
                                <span class="badge bg-warning">{{ $contacto->nivel_contacto }}</span>
                            @else
                                <span class="badge bg-info">{{ $contacto->nivel_contacto }}</span>
                            @endif
                        </p>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="col-12 mt-4">
                        <h5 class="border-bottom pb-2" style="color: #00ADED;">
                            <i class="fas fa-envelope"></i> Información de Contacto
                        </h5>
                    </div>
                    
                    <div class="col-md-12">
                        <strong class="text-muted">Email Institucional:</strong>
                        <p class="mb-0">
                            <a href="mailto:{{ $contacto->email_institucional }}" style="color: #00ADED;">
                                {{ $contacto->email_institucional }}
                            </a>
                        </p>
                    </div>

                    <!-- Estado -->
                    <div class="col-12 mt-4">
                        <h5 class="border-bottom pb-2" style="color: #00ADED;">
                            <i class="fas fa-toggle-on"></i> Estado
                        </h5>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Estado:</strong>
                        <p class="mb-0">
                            @if($contacto->activo)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
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
                        <p class="mb-0">{{ $contacto->createdBy->name ?? 'N/A' }}</p>
                        <small class="text-muted">{{ $contacto->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    
                    <div class="col-md-6">
                        <strong class="text-muted">Última actualización por:</strong>
                        <p class="mb-0">{{ $contacto->updatedBy->name ?? 'N/A' }}</p>
                        <small class="text-muted">{{ $contacto->updated_at->format('d/m/Y H:i') }}</small>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-12 mt-4 d-flex gap-2">
                        <a href="{{ route('contactos.edit', $contacto->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        
                        @if(auth()->user()->role === 'admin')
                        <button type="button" class="btn btn-danger" 
                                onclick="openDeleteModal({{ $contacto->id }}, '{{ $contacto->nombre }} {{ $contacto->apellido1 }}')">
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
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Eliminar Contacto</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        ¿Estás seguro de que deseas eliminar a <strong id="contactoName"></strong>?
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
        let deleteContactoId = null;
        
        function openDeleteModal(id, name) {
            deleteContactoId = id;
            document.getElementById('contactoName').textContent = name;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteContactoId = null;
        }
        
        document.getElementById('confirmDelete').addEventListener('click', function() {
            if (deleteContactoId) {
                const form = document.getElementById('deleteForm');
                form.action = `/contactos/${deleteContactoId}`;
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
