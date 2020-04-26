<script>

    const Toast = Swal.mixin({
        showConfirmButton: true,
        confirmButtonText: 'Close',
        allowOutsideClick: false
    })

    console.log("{{ $body }}")

    Toast.fire({
        icon: "{{ $level!=='danger'? $level :'error' }}",
        title: "{{ $title }}",
        text: "{!! $body !!}"
    })
</script>
