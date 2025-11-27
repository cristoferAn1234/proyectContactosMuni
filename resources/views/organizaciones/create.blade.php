<!-- Modal para Crear Organización -->
<div class="modal fade" id="createOrganizacionModal" tabindex="-1" aria-labelledby="createOrganizacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #00ADED; color: white;">
                <h5 class="modal-title" id="createOrganizacionModalLabel">
                    <i class="fas fa-building"></i> Nueva Organización
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('') }}" method="POST" id="createOrganizacionForm">
                @csrf
                <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
                    
                    <!-- Mostrar errores de validación -->
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Error de validación:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    <div class="row g-3">
                        
                        <!-- Información Básica -->
                        <div class="col-12">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-info-circle"></i> Información Básica
                            </h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="ced_juridica" class="form-label">Cédula Jurídica <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('ced_juridica') is-invalid @enderror" id="ced_juridica" name="ced_juridica" value="{{ old('ced_juridica') }}" required placeholder="3101123456">
                            @error('ced_juridica')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required maxlength="150">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12">
                            <label for="tipo_id" class="form-label">Tipo de Organización <span class="text-danger">*</span></label>
                            <select class="form-select @error('tipo_id') is-invalid @enderror" id="tipo_id" name="tipo_id" required>
                                <option value="">Seleccione un tipo...</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->id }}" {{ old('tipo_id') == $tipo->id ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                            @error('tipo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Información de Contacto -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-phone"></i> Información de Contacto
                            </h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono') }}" required maxlength="150" placeholder="2547-6000">
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" value="{{ old('correo') }}" required maxlength="200" placeholder="info@organizacion.go.cr">
                            @error('correo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="urlPageWeb" class="form-label">Sitio Web</label>
                            <input type="url" class="form-control @error('urlPageWeb') is-invalid @enderror" id="urlPageWeb" name="urlPageWeb" value="{{ old('urlPageWeb') }}" maxlength="200" placeholder="https://www.organizacion.go.cr">
                            @error('urlPageWeb')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="urlDirectorioTelefonico" class="form-label">URL Directorio Telefónico</label>
                            <input type="url" class="form-control @error('urlDirectorioTelefonico') is-invalid @enderror" id="urlDirectorioTelefonico" name="urlDirectorioTelefonico" value="{{ old('urlDirectorioTelefonico') }}" maxlength="200" placeholder="https://www.organizacion.go.cr/directorio">
                            @error('urlDirectorioTelefonico')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Ubicación -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-map-marker-alt"></i> Ubicación
                            </h6>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="provincia_id" class="form-label">Provincia <span class="text-danger">*</span></label>
                            <select class="form-select @error('provincia_id') is-invalid @enderror" id="provincia_id" name="provincia_id" required>
                                <option value="">Seleccione...</option>
                                @foreach($provincias as $provincia)
                                    <option value="{{ $provincia->id }}" {{ old('provincia_id') == $provincia->id ? 'selected' : '' }}>{{ $provincia->nombre }}</option>
                                @endforeach
                            </select>
                            @error('provincia_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="canton_id" class="form-label">Cantón <span class="text-danger">*</span></label>
                            <select class="form-select @error('canton_id') is-invalid @enderror" id="canton_id" name="canton_id" required>
                                <option value="">Seleccione...</option>
                                @foreach($cantones as $canton)
                                    <option value="{{ $canton->id }}" {{ old('canton_id') == $canton->id ? 'selected' : '' }}>{{ $canton->nombre }}</option>
                                @endforeach
                            </select>
                            @error('canton_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="distrito_id" class="form-label">Distrito <span class="text-danger">*</span></label>
                            <select class="form-select @error('distrito_id') is-invalid @enderror" id="distrito_id" name="distrito_id" required>
                                <option value="">Seleccione...</option>
                                @foreach($distritos as $distrito)
                                    <option value="{{ $distrito->id }}" {{ old('distrito_id') == $distrito->id ? 'selected' : '' }}>{{ $distrito->nombre }}</option>
                                @endforeach
                            </select>
                            @error('distrito_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="ubi_lat" class="form-label">Latitud</label>
                            <input type="text" class="form-control @error('ubi_lat') is-invalid @enderror" id="ubi_lat" name="ubi_lat" value="{{ old('ubi_lat') }}" maxlength="100" placeholder="9.933333">
                            @error('ubi_lat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="ubi_long" class="form-label">Longitud</label>
                            <input type="text" class="form-control @error('ubi_long') is-invalid @enderror" id="ubi_long" name="ubi_long" value="{{ old('ubi_long') }}" maxlength="100" placeholder="-84.083333">
                            @error('ubi_long')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" style="background-color: #00ADED; border-color: #00ADED;">
                        <i class="fas fa-save"></i> Guardar Organización
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
