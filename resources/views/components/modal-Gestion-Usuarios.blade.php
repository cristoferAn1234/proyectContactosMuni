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
$(document).ready(function() {
  $('#modalVerAsignaciones{{ $user->id }}').on('shown.bs.modal', function () {
    const $select = $('#modalSelectAsignaciones{{ $user->id }}');
    if (!$select.hasClass('select2-hidden-accessible')) { // evitar reinicializar
      $select.select2({
        placeholder: 'Buscar asignación...',
        dropdownParent: $('#modalVerAsignaciones{{ $user->id }}'),
        data: [
          { id: 1, text: 'Organización Alpha' },
          { id: 2, text: 'Organización Beta' },
          { id: 3, text: 'Organización Gamma' }
        ]
      });
    }
  });
});
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

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

