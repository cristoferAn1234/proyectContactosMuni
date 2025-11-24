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
                    <div class="row g-3">
                        
                        <!-- Información Personal -->
                        <div class="col-12">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-user"></i> Información Personal
                            </h6>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="100">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="apellido1" class="form-label">Primer Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1" required maxlength="150">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="apellido2" class="form-label">Segundo Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2" required maxlength="150">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="sexo" class="form-label">Sexo <span class="text-danger">*</span></label>
                            <select class="form-select" id="sexo" name="sexo" required>
                                <option value="">Seleccione...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="formacion" class="form-label">Formación Académica <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="formacion" name="formacion" required maxlength="100" placeholder="Ej: Licenciatura en Administración">
                        </div>
                        
                        <!-- Información Laboral -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-briefcase"></i> Información Laboral
                            </h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="organizacion_id" class="form-label">Organización <span class="text-danger">*</span></label>
                            <select class="form-select" id="organizacion_id" name="organizacion_id" required>
                                <option value="">Seleccione una organización...</option>
                                @foreach($organizaciones as $org)
                                    <option value="{{ $org->id }}">{{ $org->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="departamento" class="form-label">Departamento <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="departamento" name="departamento" required maxlength="100" placeholder="Ej: Recursos Humanos">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="puesto_id" class="form-label">Puesto <span class="text-danger">*</span></label>
                            <select class="form-select" id="puesto_id" name="puesto_id" required>
                                <option value="">Seleccione un puesto...</option>
                                @foreach($puestos as $puesto)
                                    <option value="{{ $puesto->id }}">{{ $puesto->nombrePuesto }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="puesto" class="form-label">Título del Puesto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="puesto" name="puesto" required maxlength="100" placeholder="Ej: Director de RRHH">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="extension" class="form-label">Extensión Telefónica</label>
                            <input type="text" class="form-control" id="extension" name="extension" maxlength="100" placeholder="Ej: 1234">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="nivel_contacto" class="form-label">Nivel de Contacto <span class="text-danger">*</span></label>
                            <select class="form-select" id="nivel_contacto" name="nivel_contacto" required>
                                <option value="">Seleccione...</option>
                                <option value="Alto">Alto</option>
                                <option value="Medio">Medio</option>
                                <option value="Bajo">Bajo</option>
                            </select>
                        </div>
                        
                        <!-- Información de Contacto -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-envelope"></i> Información de Contacto
                            </h6>
                        </div>
                        
                        <div class="col-md-12">
                            <label for="email_institucional" class="form-label">Email Institucional <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email_institucional" name="email_institucional" required maxlength="100" placeholder="ejemplo@institucion.go.cr">
                        </div>
                        
                        <!-- Estado -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-toggle-on"></i> Estado
                            </h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="activo" class="form-label">Estado del Contacto <span class="text-danger">*</span></label>
                            <select class="form-select" id="activo" name="activo" required>
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
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
