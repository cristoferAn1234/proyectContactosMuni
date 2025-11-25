@props(['user'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- jQuery y Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@push('scripts')
<script>


 async function cargarOrganizacionesDisponibles() {
    try {
        const response = await axios.get('/organizaciones/disponibles');

        return response.data.map(org => ({
            id: org.id,
            text: org.nombre
        }));

    } catch (error) {
        console.error("Error cargando organizaciones:", error);
        return [];
    }
}  


 $(document).ready(function () {
    const userId = '{{ $user->id }}';
    $('#modalVerAsignaciones' + userId).on('shown.bs.modal', async function () {
      const $select = $('#modalSelectAsignaciones' + userId);

      if (!$select.hasClass('select2-hidden-accessible')) {
        const data = await cargarOrganizacionesDisponibles();

        $select.select2({
          placeholder: 'Buscar organización...',
          dropdownParent: $('#modalVerAsignaciones' + userId),
          data: data
        });
      }

   
      $select.on('select2:select', function (e) {
        const org = e.params.data;

        agregarFilaATabla(userId, org);

        // 2. Remover del Select2 (ya no disponible)
        $select.find(`option[value="${org.id}"]`).remove();
        $select.trigger('change'); // refrescar select2
      });

    });
  });

//Agregar organización al usuario
function agregarFilaATabla(userId, org) {
  asignarOrganizacionAUsuario(userId, org.id);
    const fila = `
        <tr id="row-org-${org.id}">
            <td>${org.id}</td>
            <td>${org.text}</td>
            <td>N/A</td>
            <td>
                <button class="btn btn-danger btn-sm" type="button" onclick="eliminarAsignacion(${userId}, ${org.id})">
                    Eliminar
                </button>
            </td>
        </tr>
    `;

    $(`#tablaAsignaciones${userId} tbody`).append(fila);
}


//cRargar asignaciones actuales al abrir el modal
function cargarAsignacionesActuales() {
  $('#modalVerAsignaciones{{ $user->id }}').on('shown.bs.modal', async function () {
    try {
    
        const response = await axios.get(`/organizaciones/{{ $user->id }}/asignaciones`);
        const asignaciones = response.data;                   
        asignaciones.forEach(org =>   {
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
            $(`#tablaAsignaciones{{ $user->id }} tbody`).append(fila);
        });
    } catch (error) {
        console.error("Error cargando asignaciones:", error);
    }
});  
}

cargarAsignacionesActuales();
//Eliminar asignación de organización al usuario
async function eliminarAsignacion(userId, orgId) {
    if (!confirm("¿Seguro que querés eliminar esta asignación?")) return;

    try {
        const response = await axios.delete(`/organizaciones/delete/${orgId}/user/${userId}`);
      
       
        $(`#row-org-${orgId}`).remove();

        const $select = $('#modalSelectAsignaciones' + userId);

        //const newOption = new Option(response.data.nombre, orgId, false, false);
       // $select.append(newOption).trigger('change');

        alert("Asignación eliminada correctamente");

    } catch (error) {
        console.error("Error eliminando asignación:", error);
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
        console.error("Error asignando organización:", error);
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
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">
        <select id="modalSelectAsignaciones{{ $user->id }}" class="form-control"></select>
        <p>Aquí podés mostrar las asignaciones del usuario {{ $user->id }}.</p>
      </div>
    <table class="table" id="tablaAsignaciones{{ $user->id }}">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre</th>
      <th scope="col">Tipo</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <!-- Se llena por Axios -->
  </tbody>
</table>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

