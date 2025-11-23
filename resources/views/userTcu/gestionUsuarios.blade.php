<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.asideBar')
        <!-- Contenido principal -->
        <main class="flex-1 p-8 bg-gray-100 dark:bg-gray-800">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
                {{ __('Gestion de Usuarios') }}
            </h2>
            <div class="rounded-lg border-2 border-gray-300 bg-white bg-opacity-40 shadow-inner p-4 mb-6">
                <div class="table-responsive">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-dark-200 mb-4">Lista de Usuarios </h2>
                        
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Estado</th>
                                <th scope="col">ver Asignaciones</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->aprobado }}</td>
                                <td>
                                    <form action="{{ url('/users/' . $user->id . '/assignments') }}" id="formVerAsignaciones{{$user->id}}" method="GET" style="display:inline;">
                                        @csrf
                                        <button type="button" class="btn btn-info btn-sm" id="btnVerAsignaciones{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#modalVerAsignaciones{{ $user->id }}">Ver Asignaciones</button>
                                    </form>
                                    <x-modal-Gestion-Usuarios :user="$user" :asignaciones="$user->asignaciones" />
                                </td>
                                <td>
                                    @if($user->aprobado == 'aprobado')
                                    <form action="{{ url('/users/' . $user->id . '/approve') }}" id="formAprobar{{$user->id}}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="button" class="btn btn-success btn-sm" id="btnConfirmar{{ $user->id }}">Editar</button>
                                        <x-confirm-alert
                                            formId="formAprobar{{ $user->id }}"
                                            title="¿Aprobar usuario?"
                                            text="El usuario será aprobado."
                                            confirmText="Sí, aprobar"
                                            cancelText="Cancelar"
                                            icon="question"
                                            buttonId="btnConfirmar{{ $user->id }}" />
                                    </form>
                                    <form action="{{ url('/users/' . $user->id . '/reject') }}" id="formRechazar{{$user->id}}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm" id="btnRechazar{{ $user->id }}">Eliminar</button>
                                        <x-confirm-alert
                                            formId="formRechazar{{ $user->id }}"
                                            buttonId="btnRechazar{{ $user->id }}"
                                            title="¿Eliminar usuario?"
                                            text="El usuario será eliminado."
                                            confirmText="Sí, eliminar"
                                            cancelText="Cancelar"
                                            icon="question" />
                                    </form>
                                    @else
                                    <span class="text-secondary">Sin acciones</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                      @include('components.backend-alert')
                </div>
             
            </div>


</x-app-layout> 
@section('scripts')
<script>
function abrirModalUsuario() {
  const modal = new bootstrap.Modal(document.getElementById('modalUsuario'));
  modal.show();
}
</script>
@endsection

@stack('scripts')