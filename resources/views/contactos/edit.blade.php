<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.asideBar')

        <!-- Contenido principal -->
        <main class="flex-1 p-8 bg-gray-100 dark:bg-gray-800">
            <div class="rounded-lg border-2 border-gray-300 bg-white bg-opacity-40 shadow-inner p-6">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        <i class="fas fa-user-edit"></i> Editar Contacto
                    </h2>
                    <a href="{{ route('contactos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <form action="{{ route('contactos.update', $contacto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <!-- Información Personal -->
                        <div class="col-12">
                            <h6 class="text-muted border-bottom pb-2">
                                <i class="fas fa-user"></i> Información Personal
                            </h6>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $contacto->nombre) }}" required maxlength="100">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="apellido1" class="form-label">Primer Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1" value="{{ old('apellido1', $contacto->apellido1) }}" required maxlength="150">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="apellido2" class="form-label">Segundo Apellido <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2" value="{{ old('apellido2', $contacto->apellido2) }}" required maxlength="150">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="sexo" class="form-label">Sexo <span class="text-danger">*</span></label>
                            <select class="form-select" id="sexo" name="sexo" required>
                                <option value="">Seleccione...</option>
                                <option value="Masculino" {{ old('sexo', $contacto->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('sexo', $contacto->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Otro" {{ old('sexo', $contacto->sexo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="formacion" class="form-label">Formación Académica <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="formacion" name="formacion" value="{{ old('formacion', $contacto->formacion) }}" required maxlength="100" placeholder="Ej: Licenciatura en Administración">
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
                                    <option value="{{ $org->id }}" {{ old('organizacion_id', $contacto->organizacion_id) == $org->id ? 'selected' : '' }}>{{ $org->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="departamento" class="form-label">Departamento <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="departamento" name="departamento" value="{{ old('departamento', $contacto->departamento) }}" required maxlength="100" placeholder="Ej: Recursos Humanos">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="puesto_id" class="form-label">Puesto <span class="text-danger">*</span></label>
                            <select class="form-select" id="puesto_id" name="puesto_id" required>
                                <option value="">Seleccione un puesto...</option>
                                @foreach($puestos as $puesto)
                                    <option value="{{ $puesto->id }}" {{ old('puesto_id', $contacto->puesto_id) == $puesto->id ? 'selected' : '' }}>{{ $puesto->nombrePuesto }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="puesto" class="form-label">Título del Puesto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="puesto" name="puesto" value="{{ old('puesto', $contacto->puesto) }}" required maxlength="100" placeholder="Ej: Director de RRHH">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="extension" class="form-label">Extensión Telefónica</label>
                            <input type="text" class="form-control" id="extension" name="extension" value="{{ old('extension', $contacto->extension) }}" maxlength="100" placeholder="Ej: 1234">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="nivel_contacto" class="form-label">Nivel de Contacto <span class="text-danger">*</span></label>
                            <select class="form-select" id="nivel_contacto" name="nivel_contacto" required>
                                <option value="">Seleccione...</option>
                                <option value="Alto" {{ old('nivel_contacto', $contacto->nivel_contacto) == 'Alto' ? 'selected' : '' }}>Alto</option>
                                <option value="Medio" {{ old('nivel_contacto', $contacto->nivel_contacto) == 'Medio' ? 'selected' : '' }}>Medio</option>
                                <option value="Bajo" {{ old('nivel_contacto', $contacto->nivel_contacto) == 'Bajo' ? 'selected' : '' }}>Bajo</option>
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
                            <input type="email" class="form-control" id="email_institucional" name="email_institucional" value="{{ old('email_institucional', $contacto->email_institucional) }}" required maxlength="100" placeholder="ejemplo@institucion.go.cr">
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
                                <option value="1" {{ old('activo', $contacto->activo) == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('activo', $contacto->activo) == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                        
                        <!-- Botones -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary" style="background-color: #00ADED; border-color: #00ADED;">
                                <i class="fas fa-save"></i> Actualizar Contacto
                            </button>
                            <a href="{{ route('contactos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
</x-app-layout>

