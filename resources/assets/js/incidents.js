
var datatableLatestOrders = function() {
    if ($('#m_datatable_incidents').length === 0) {
        return;
    }

    var datatable = $('.m_datatable').mDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/api/incidents'
                }
            },
            pageSize: 10,
            saveState: {
                cookie: false,
                webstorage: true
            },
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },

        layout: {
            theme: 'default',
            class: '',
            scroll: true,
            height: 380,
            footer: false
        },

        sortable: true,

        filterable: false,

        pagination: true,

        columns: [{
            field: "id",
            title: "#",
            sortable: false,
            width: 40,
            selector: {
                class: 'm-checkbox--solid m-checkbox--brand'
            },
            textAlign: 'center'
        }, {
            field: "reference",
            title: "Reference",
            sortable: 'asc',
            filterable: false,
            width: 150,
            template: '{{OrderID}} - {{ShipCountry}}'
        }, {
            field: "name",
            title: "Name",
            width: 150,
            responsive: {
                visible: 'lg'
            }
        }, {
            field: "ShipDate",
            title: "Ship Date"
        }, {
            field: "Status",
            title: "Status",
            width: 100,
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {
                        'title': 'Pending',
                        'class': 'm-badge--brand'
                    },
                    2: {
                        'title': 'Delivered',
                        'class': ' m-badge--metal'
                    },
                    3: {
                        'title': 'Canceled',
                        'class': ' m-badge--primary'
                    },
                    4: {
                        'title': 'Success',
                        'class': ' m-badge--success'
                    },
                    5: {
                        'title': 'Info',
                        'class': ' m-badge--info'
                    },
                    6: {
                        'title': 'Danger',
                        'class': ' m-badge--danger'
                    },
                    7: {
                        'title': 'Warning',
                        'class': ' m-badge--warning'
                    }
                };
                return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
            }
        }, {
            field: "Type",
            title: "Type",
            width: 100,
            // callback function support for column rendering
            template: function(row) {
                var status = {
                    1: {
                        'title': 'Online',
                        'state': 'danger'
                    },
                    2: {
                        'title': 'Retail',
                        'state': 'primary'
                    },
                    3: {
                        'title': 'Direct',
                        'state': 'accent'
                    }
                };
                return '<span class="m-badge m-badge--' + status[row.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
            }
        }, {
            field: "Actions",
            width: 110,
            title: "Actions",
            sortable: false,
            overflow: 'visible',
            template: function(row, index, datatable) {
                var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
                return '\
                        <div class="dropdown ' + dropup + '">\
                            <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                <i class="la la-ellipsis-h"></i>\
                            </a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
                            </div>\
                        </div>\
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\
                            <i class="la la-edit"></i>\
                        </a>\
                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\
                            <i class="la la-trash"></i>\
                        </a>\
                    ';
            }
        }]
    });
}
