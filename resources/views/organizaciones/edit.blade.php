<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.asideBar')

        <!-- Contenido principal -->
        <main class="flex-1 p-8 bg-gray-100 dark:bg-gray-800">
            <div class="rounded-lg border-2 border-gray-300 bg-white bg-opacity-40 shadow-inner p-6">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-building-edit"></i> Editar Organización
                    </h2>
                    <a href="{{ route('organizaciones.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <form action="{{ route('organizaciones.update', $organizacion->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <!-- Información Básica -->
                        <div class="col-12">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-info-circle"></i> Información Básica
                            </h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="ced_juridica" class="form-label">Cédula Jurídica <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="ced_juridica" name="ced_juridica" value="{{ old('ced_juridica', $organizacion->ced_juridica) }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $organizacion->nombre) }}" required maxlength="150">
                        </div>
                        
                        <div class="col-md-12">
                            <label for="tipo_id" class="form-label">Tipo de Organización <span class="text-danger">*</span></label>
                            <select class="form-select" id="tipo_id" name="tipo_id" required>
                                <option value="">Seleccione un tipo...</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ old('tipo_id', $organizacion->tipo_id) == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Información de Contacto -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-phone"></i> Información de Contacto
                            </h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $organizacion->telefono) }}" required maxlength="150">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $organizacion->correo) }}" required maxlength="200">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="urlPageWeb" class="form-label">Sitio Web</label>
                            <input type="url" class="form-control" id="urlPageWeb" name="urlPageWeb" value="{{ old('urlPageWeb', $organizacion->urlPageWeb) }}" maxlength="200">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="urlDirectorioTelefonico" class="form-label">URL Directorio Telefónico</label>
                            <input type="url" class="form-control" id="urlDirectorioTelefonico" name="urlDirectorioTelefonico" value="{{ old('urlDirectorioTelefonico', $organizacion->urlDirectorioTelefonico) }}" maxlength="200">
                        </div>
                        
                        <!-- Ubicación -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-map-marker-alt"></i> Ubicación
                            </h6>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="provincia_id" class="form-label">Provincia <span class="text-danger">*</span></label>
                            <select class="form-select" id="provincia_id" name="provincia_id" required>
                                <option value="">Seleccione...</option>
                                @foreach($provincias as $provincia)
                                    <option value="{{ $provincia->id }}" {{ old('provincia_id', $organizacion->provincia_id) == $provincia->id ? 'selected' : '' }}>{{ $provincia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="canton_id" class="form-label">Cantón <span class="text-danger">*</span></label>
                            <select class="form-select" id="canton_id" name="canton_id" required>
                                <option value="">Seleccione...</option>
                                @foreach($cantones as $canton)
                                    <option value="{{ $canton->id }}" {{ old('canton_id', $organizacion->canton_id) == $canton->id ? 'selected' : '' }}>{{ $canton->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="distrito_id" class="form-label">Distrito <span class="text-danger">*</span></label>
                            <select class="form-select" id="distrito_id" name="distrito_id" required>
                                <option value="">Seleccione...</option>
                                @foreach($distritos as $distrito)
                                    <option value="{{ $distrito->id }}" {{ old('distrito_id', $organizacion->distrito_id) == $distrito->id ? 'selected' : '' }}>{{ $distrito->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="ubi_lat" class="form-label">Latitud</label>
                            <input type="text" class="form-control" id="ubi_lat" name="ubi_lat" value="{{ old('ubi_lat', $organizacion->ubi_lat) }}" maxlength="100">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="ubi_long" class="form-label">Longitud</label>
                            <input type="text" class="form-control" id="ubi_long" name="ubi_long" value="{{ old('ubi_long', $organizacion->ubi_long) }}" maxlength="100">
                        </div>
                        
                        <!-- Botones -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary" style="background-color: #00ADED; border-color: #00ADED;">
                                <i class="fas fa-save"></i> Actualizar Organización
                            </button>
                            <a href="{{ route('organizaciones.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-app-layout>
