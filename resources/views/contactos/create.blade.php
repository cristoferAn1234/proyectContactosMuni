<!-- Modal para Crear Contacto -->
<div class="modal fade" id="createContactoModal" tabindex="-1" aria-labelledby="createContactoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #00ADED; color: white;">
                <h5 class="modal-title" id="createContactoModalLabel">
                    <i class="fas fa-user-plus"></i> Nuevo Contacto
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('contactos.store') }}" method="POST" id="createContactoForm">
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
                        
                        <!-- Información Personal -->
                        <div class="col-12">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-user"></i> Información Personal
                            </h6>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required maxlength="100">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="apellido1" class="form-label">Primer Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('apellido1') is-invalid @enderror" id="apellido1" name="apellido1" value="{{ old('apellido1') }}" required maxlength="150">
                            @error('apellido1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="apellido2" class="form-label">Segundo Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('apellido2') is-invalid @enderror" id="apellido2" name="apellido2" value="{{ old('apellido2') }}" required maxlength="150">
                            @error('apellido2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="sexo" class="form-label">Sexo <span class="text-danger">*</span></label>
                            <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo" required>
                                <option value="">Seleccione...</option>
                                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Otro" {{ old('sexo') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('sexo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="formacion" class="form-label">Formación Académica <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('formacion') is-invalid @enderror" id="formacion" name="formacion" value="{{ old('formacion') }}" required maxlength="100" placeholder="Ej: Licenciatura en Administración">
                            @error('formacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Información Laboral -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-briefcase"></i> Información Laboral
                            </h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="organizacion_id" class="form-label">Organización <span class="text-danger">*</span></label>
                            <select class="form-select @error('organizacion_id') is-invalid @enderror" id="organizacion_id" name="organizacion_id" required>
                                <option value="">Seleccione una organización...</option>
                                @foreach($organizaciones as $org)
                                    <option value="{{ $org->id }}" {{ old('organizacion_id') == $org->id ? 'selected' : '' }}>{{ $org->nombre }}</option>
                                @endforeach
                            </select>
                            @error('organizacion_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="departamento" class="form-label">Departamento <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('departamento') is-invalid @enderror" id="departamento" name="departamento" value="{{ old('departamento') }}" required maxlength="100" placeholder="Ej: Recursos Humanos">
                            @error('departamento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="puesto_id" class="form-label">Puesto <span class="text-danger">*</span></label>
                            <select class="form-select @error('puesto_id') is-invalid @enderror" id="puesto_id" name="puesto_id" required>
                                <option value="">Seleccione un puesto...</option>
                                @foreach($puestos as $puesto)
                                    <option value="{{ $puesto->id }}" {{ old('puesto_id') == $puesto->id ? 'selected' : '' }}>{{ $puesto->nombrePuesto }}</option>
                                @endforeach
                            </select>
                            @error('puesto_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="puesto" class="form-label">Título del Puesto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('puesto') is-invalid @enderror" id="puesto" name="puesto" value="{{ old('puesto') }}" required maxlength="100" placeholder="Ej: Director de RRHH">
                            @error('puesto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="extension" class="form-label">Extensión Telefónica</label>
                            <input type="text" class="form-control @error('extension') is-invalid @enderror" id="extension" name="extension" value="{{ old('extension') }}" requiredmaxlength="100" placeholder="Ej: 1234">
                            @error('extension')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="nivel_contacto" class="form-label">Nivel de Contacto <span class="text-danger">*</span></label>
                            <select class="form-select @error('nivel_contacto') is-invalid @enderror" id="nivel_contacto" name="nivel_contacto" required>
                                <option value="">Seleccione...</option>
                                <option value="Alto" {{ old('nivel_contacto') == 'Alto' ? 'selected' : '' }}>Alto</option>
                                <option value="Medio" {{ old('nivel_contacto') == 'Medio' ? 'selected' : '' }}>Medio</option>
                                <option value="Bajo" {{ old('nivel_contacto') == 'Bajo' ? 'selected' : '' }}>Bajo</option>
                            </select>
                            @error('nivel_contacto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Información de Contacto -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-envelope"></i> Información de Contacto
                            </h6>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="email_institucional" class="form-label">Email Institucional <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email_institucional') is-invalid @enderror" id="email_institucional" name="email_institucional" value="{{ old('email_institucional') }}" required maxlength="100" placeholder="ejemplo@institucion.go.cr">
                            @error('email_institucional')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Estado -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-toggle-on"></i> Estado
                            </h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="activo" class="form-label">Estado del Contacto <span class="text-danger">*</span></label>
                            <select class="form-select @error('activo') is-invalid @enderror" id="activo" name="activo" required>
                                <option value="1" {{ old('activo', '1') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('activo')
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
                        <i class="fas fa-save"></i> Guardar Contacto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
