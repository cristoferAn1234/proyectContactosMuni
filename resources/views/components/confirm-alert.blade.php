@props([
    'formId', 
    'buttonId',
    'title' => '¿Estás seguro?',
    'text' => 'Se enviarán los datos del formulario.',
    'confirmText' => 'Sí, continuar',
    'cancelText' => 'Cancelar',
    'icon' => 'question'
])



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const button = document.querySelector('#{{ $buttonId }}');
    if (button) {
        button.addEventListener('click', function() {
            Swal.fire({
                title: '{{ $title }}',
                text: '{{ $text }}',
                icon: '{{ $icon }}',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ $confirmText }}',
                cancelButtonText: '{{ $cancelText }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('{{ $formId }}').submit();
                }
            });
        });
    }
});
</script>
