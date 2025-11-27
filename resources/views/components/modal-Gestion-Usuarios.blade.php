@props(['user'])

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@push('scripts')
<script>

async function cargarOrganizacionesDisponibles() {
    try {
        const response = await axios.get('/organizaciones/disponibles');
        console.log(response.data.map(org => ({ id: org.id, text: org.nombre, tipo: org.tipo ? org.tipo.nombre : 'N/A' })));
        return response.data.map(org => ({ id: org.id, text: org.nombre, tipo: org.tipo ? org.tipo.nombre : 'N/A' }));
      
    } catch {
        return [];
    }
}
function configurarModalAsignaciones(userId) {

    const $modal = $('#modalVerAsignaciones' + userId);
    const $select = $('#modalSelectAsignaciones' + userId);

    $modal.on('shown.bs.modal', async function () {

        if (!$select.hasClass('select2-hidden-accessible')) {

            const data = await cargarOrganizacionesDisponibles();

            $select.html('<option value=""></option>');

            $select.select2({
                placeholder: 'Buscar organización...',
                dropdownParent: $modal,
                data: data
            });
        }

        // Evita eventos duplicados
        $select.off('select2:select').on('select2:select', function (e) {

            const org = e.params.data;

            agregarFilaATabla(userId, org, org.tipo);

            $select.find(`option[value="${org.id}"]`).remove();
            $select.trigger('change');
        });
    });
}

$(document).ready(function () {
    configurarModalAsignaciones('{{ $user->id }}');
});

function agregarFilaATabla(userId, org, tipo) {
    asignarOrganizacionAUsuario(userId, org.id);

    const fila = `
        <tr id="row-org-${org.id}">
            <td>${org.id}</td>
            <td>${org.text}</td>
            <td>${tipo}</td>
            <td>
                <button class="btn btn-danger btn-sm" type="button" onclick="eliminarAsignacion(${userId}, ${org.id})">
                    Eliminar
                </button>
            </td>
        </tr>
    `;

    $(`#tablaAsignaciones${userId} tbody`).append(fila);
}

function cargarAsignacionesActuales() {
    $('#modalVerAsignaciones{{ $user->id }}').on('shown.bs.modal', async function () {
        try {
            const response = await axios.get(`/organizaciones/{{ $user->id }}/asignaciones`);
            const asignaciones = response.data;
       
            const tbody = $(`#tablaAsignaciones{{ $user->id }} tbody`);
            tbody.empty();

            asignaciones.forEach(org => {
                const fila = `
                    <tr id="row-org-${org.id}">
                        <td>${org.id}</td>
                        <td>${org.nombre}</td>
                        <td>${org.tipo ? org.tipo.nombre : 'N/A'}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" type="button" onclick="eliminarAsignacion({{ $user->id }}, ${org.id})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
                tbody.append(fila);
            });
        } catch {}
    });
}

cargarAsignacionesActuales();

async function eliminarAsignacion(userId, orgId) {
    if (!confirm("¿Seguro que querés eliminar esta asignación?")) return;

    try {
        const response = await axios.delete(`/organizaciones/delete/${orgId}/user/${userId}`);

       $(`#row-org-${orgId}`).remove();
       const $select = $('#modalSelectAsignaciones' + userId);

        // Destruir Select2 actual
        $select.select2('destroy');

        // Vaciar el select
        $select.html('<option value=""></option>');

       const data = await cargarOrganizacionesDisponibles();

        // Reconstruir Select2 con los datos nuevos
        $select.select2({
            placeholder: 'Buscar organización...',
            dropdownParent: $('#modalVerAsignaciones' + userId),
            data: data
        });

        alert("Asignación eliminada correctamente");
    } catch {
        alert("No se pudo eliminar");
    }
}

async function asignarOrganizacionAUsuario(userId, orgId) {
    try {
        const response = await axios.post('/organizaciones/AsignarUsuario', {
            user_id: userId,
            organizacion_id: orgId
        });

        return response.data;
    } catch (error) {
        throw error;
    }
}

</script>
@endpush
<div class="modal fade" id="modalVerAsignaciones{{ $user->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel{{ $user->id }}">
          Asignaciones de {{ $user->name ?? 'Usuario' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <select id="modalSelectAsignaciones{{ $user->id }}" class="form-control"></select>
        <p>Asignaciones del usuario {{ $user->id }}.</p>
      </div>

      <table class="table" id="tablaAsignaciones{{ $user->id }}">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
