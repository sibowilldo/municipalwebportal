//== Class definition

var DatatableRemoteAjaxDemo = function() {
    //== Private functions

    // basic demo
    var demo = function() {

        var datatable = $('.m_datatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/api/incidents',
                        method: 'GET',
                        map: function(raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data.data;
                            }
                            return dataSet;
                        },
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false,
                footer: false
            },

            // column sorting
            sortable: true,

            pagination: true,

            toolbar: {
                layout: ['pagination', 'info'],

                placement: ['bottom'],  //'top', 'bottom'

                items: {
                    pagination: {
                        type: 'default',

                        pages: {
                            desktop: {
                                layout: 'default',
                                pagesNumber: 6
                            },
                            tablet: {
                                layout: 'default',
                                pagesNumber: 3
                            },
                            mobile: {
                                layout: 'compact'
                            }
                        },

                        navigation: {
                            prev: true,
                            next: true,
                            first: true,
                            last: true
                        },

                        pageSizeSelect: [10, 20, 30, 50, 100]
                    },

                    info: true
                }
            },

            translate: {
                records: {
                    processing: 'Please wait...',
                    noRecords: 'No records found'
                },
                toolbar: {
                    pagination: {
                        items: {
                            default: {
                                first: 'First',
                                prev: 'Previous',
                                next: 'Next',
                                last: 'Last',
                                more: 'More pages',
                                input: 'Page number',
                                select: 'Select page size'
                            },
                            info: 'Displaying {{start}} - {{end}} of {{total}} records'
                        }
                    }
                }
            },

            search: {
                input: $('#generalSearch'),
            },

            // columns definition
            columns: [
                {
                    field: 'id',
                    title: '#',
                    sortable: true, // disable sort for this column
                    width: 40,
                    selector: false,
                    textAlign: 'center',
                },
                {
                    field: 'reference',
                    title: 'Reference',
                    sortable: false, // disable sort for this column
                    width: 150,
                    selector: false,
                    textAlign: 'center',
                },
                {
                    field: 'name',
                    title: 'Name',
                    filterable: false, // disable or enable filtering
                    width: 150,
                },
                {
                    field: 'created',
                    title: 'Logged At',
                    attr: {nowrap: 'nowrap'},
                    width: 150,
                    type: 'date',
                    format: 'MM/DD/YYYY',
                },
                {
                    field: 'Status',
                    title: 'Status',
                    // callback function support for column rendering
                    template: function(row) {
                        var status = arrStatus;
                        return '<span class="m-badge m-badge--' + status[row.status.id].class + ' m-badge--wide">' + status[row.status.id].title + '</span>';
                    },
                },
                {
                    field: 'category',
                    title: 'Category',
                    // callback function support for column rendering
                    template: function(row) {
                        var category = arrCategories;
                        return '<span class="m-badge m-badge--' + category[row.category.id].class + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + category[row.category.id].class + '">' +
                            category[row.category.id].title + '</span>';
                    },
                },
                {
                    field: 'location',
                    title: 'Location',
                    // basic templating support for column rendering,
                    template: '{{longitude}}, {{latitude}}',
                },
                {
                    field: 'suburb_id',
                    title: 'Suburb',
                    width: 100,
                },
                {
                    field: 'Actions',
                    width: 110,
                    title: 'Actions',
                    sortable: false,
                    overflow: 'visible',
                    template: function (row, index, datatable) {
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
                    },
                }],
        });

        $('#m_form_status').on('change', function() {
            datatable.search($(this).val(), 'Status');
        });

        $('#m_form_type').on('change', function() {
            datatable.search($(this).val(), 'Type');
        });

        $('#m_form_status, #m_form_type').selectpicker();

    };

    return {
        // public functions
        init: function() {
            demo();
        },
    };
}();
var arrCategories = [];
var LoadCategories = function () {
    var categories = function () {
        $.ajax({
            url: '/api/system/categories',
            type: "GET",
            dataType: "json",
            complete: function (data) {
                arrCategories = data.responseJSON.data;
                $('#loader').css("visibility", "hidden");
            }
        });
    }
    return {
        init: function () {
            categories();
        }
    }
}();
var arrStatus = [];
var LoadStatuses = function () {
    var statuses = function () {
        $.ajax({
            url: '/api/system/statuses',
            type: "GET",
            dataType: "json",
            complete: function (data) {
                arrStatus = data.responseJSON.data;
                $('#loader').css("visibility", "hidden");
            }
        });
    }
    return {
        init: function () {
            statuses();
        }
    }
}();
jQuery(document).ready(function() {
    LoadCategories.init();
    LoadStatuses.init();
    DatatableRemoteAjaxDemo.init();
});
