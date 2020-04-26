//== Set defaults
const swalDelete = Swal.mixin({
    showCancelButton: true,
    confirmButtonText: 'Yes, I\'m sure!',
    buttonsStyling: false,
    icon: 'warning',
    focusCancel: true,
    focusConfirm: false,
    customClass: {
        confirmButton: 'btn btn-secondary m-btn m-btn--custom text-dark',
        cancelButton: 'btn btn-danger m-btn m-btn--custom',
    },
    allowOutsideClick: false
});

const swalToast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: true,
    timer: 9000,
    timerProgressBar: true,
    customClass: {
        container: 'mt-5',
        popup: 'mt-5',
        confirmButton: 'btn m-btn m-btn--custom btn-success',
    },
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
