const LoadDeleteFx = (function(){
    var deleteFx = function(ev, el){
        ev.preventDefault();

        var id = el.data('id');
        var url = el.data('url');
        var token = $('meta[name="csrf-token"]').attr('content');
        Swal.fire({
            title: 'Are you sure?',
            text: 'You may not be able to undo this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        url: url,
                        type: 'delete',
                        data: {
                            'id': id,
                            '_token': token
                        }
                    })
                        .done(function(response){
                            Swal.fire({
                                title: 'Deleted!',
                                text: response.message,
                                onClose: function() {
                                    window.location.href = response.url;
                                }
                            });
                        })
                        .fail(function(){
                            swal('Oops...', 'Something went wrong with ajax !', 'error');
                        });
                });
            },
            allowOutsideClick: false
        });
    }
    return {
        init: function(ev, el){
            deleteFx(ev, el);
        }
    };
}());

const TableElement = function() {
    var table = function(element, columns) {
        var datatable = element.mDatatable({
            data: {
                saveState: {cookie: false}
            },
            layout: {
                theme: 'default',
                class: '',
                scroll: true,
                height: 550,
                footer: false
            },
            rows: {
                // auto hide columns, if rows overflow
                autoHide: true,
            },
            sortable: true,
            filterable: false,
            pagination: true,
            search: {
                input: $('#generalSearch')
            },
            columns: columns,
        }).on('click','.btn-delete' , function(ev){
            var el = $(this);
            LoadDeleteFx.init(ev, el);
        });

        TableMethods.init(datatable);

    };

    return {
        //== Public functions
        init: function(element, columns) {
            // init permissions
            table(element, columns);
        },
    };
}();