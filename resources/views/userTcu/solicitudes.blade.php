<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.asideBar')

        <!-- Contenido principal -->
        <main class="flex-1 p-8 bg-gray-100 dark:bg-gray-800">
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
                {{ __('Solicitudes de Usuarios') }}
            </h2>
            <P style="color: #00ADED;">Gestiona las Solicitudes de nuevos usuarios desde aquí.</P>
            <div class="rounded-lg border-2 border-gray-300 bg-white bg-opacity-40 shadow-inner p-4 mb-6">
                <div class="table-responsive">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-dark-200 mb-4">Solicitudes </h2>
                        <form method="post" action="{{ route('users.filter') }}" id="filterForm">
                            @csrf
                            <div style="display:flex; gap:8px; align-items:center; width:100%; justify-content:flex-end;">
                                <select name="status" id="filterStatus" class="form-select" style="width:100%;" onchange="this.form.submit()">
                                    <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>Todos</option>
                                    <option value="pendiente" {{ request('status') == 'pendiente' ? 'selected' : '' }}>Pendientes</option>
                                    <option value="aprobado" {{ request('status') == 'aprobado' ? 'selected' : '' }}>Aprobados</option>
                                    <option value="no_aprobado" {{ request('status') == 'no_aprobado' ? 'selected' : '' }}>No Aprobados</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    @if($user->aprobado == 'pendiente')
                                    <span class="text-warning">Pendiente</span>
                                    @elseif($user->aprobado == 'aprobado')
                                    <span class="text-success">Aprobado</span>
                                    @else
                                    <span class="text-danger">No aprobado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->aprobado == 'pendiente')
                                    <form action="{{ url('/users/' . $user->id . '/approve') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                                    </form>
                                    <form action="{{ url('/users/' . $user->id . '/reject') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                                    </form>
                                    @else
                                    <span class="text-secondary">Sin acciones</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


</x-app-layout>