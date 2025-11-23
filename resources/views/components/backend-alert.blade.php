<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        Swal.fire({
            title: "Éxito",
            text: "{{ addslashes(session('success')) }}",
            icon: "success",
            confirmButtonColor: "#3085d6"
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: "Error",
            text: "{{ addslashes(session('error')) }}",
            icon: "error",
            confirmButtonColor: "#d33"
        });
    </script>
@endif

