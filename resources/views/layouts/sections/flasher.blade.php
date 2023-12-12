<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let status = "{{Session::get('status') ?? ''}}";

    if (status === "success") {
        console.info('ok')
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: "{{Session::get('message')}}",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        })
    } else if (status === "error") {
        console.info('a')
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: "{{Session::get('message')}}",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        })
    }
</script>
