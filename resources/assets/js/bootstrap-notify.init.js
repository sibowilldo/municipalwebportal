$.notifyDefaults({
    allow_dismiss: true,
    newest_on_top: false,
    mouse_over:  true,
    showProgressbar: false,
    spacing: 10,
    timer: 5000,
    placement: {
        from: 'top',
        align: 'right'
    },
    offset: {
        x: 30,
        y: 30
    },
    delay:1000,
    z_index:10000,
    animate: {
        enter: 'animated fadeInUp',
        exit: 'animated fadeOutUp'
    }
});