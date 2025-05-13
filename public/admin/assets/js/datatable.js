

$(document).ready(function() {
if ($('.categoryList').length) {
    $('.categoryList').DataTable({
    serverSide: true,
    processing: true,
    responsive: true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
    language: {
        lengthMenu: '<select class="form-select">'+
                        '<option value="10">10</option>'+
                        '<option value="25">25</option>'+
                        '<option value="50">50</option>'+
                        '<option value="100">100</option>'+
                    '</select>'
    },
    buttons: [
        {
            extend: 'collection',
            text: '<i class="bi bi-download"></i>',
            className: 'btn btn-light dropdown-toggle',
            buttons: [
                {
                    extend: 'csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: [0, 1, 2, 3] }
                },
                {
                    extend: 'excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: [0, 1, 2, 3] }
                },
                {
                    extend: 'pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: [0, 1, 2, 3] }
                },
                {
                    extend: 'print',
                    className: 'dropdown-item',
                    exportOptions: { columns: [0, 1, 2, 3] }
                }
            ]
        }
    ],
    ajax: {
        url: categoryUrl
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'category_name', name: 'category_name' },
        { data: 'description', name: 'description' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]

});
}

/////Crop Management List
if ($('#cropmanagementList').length) {
    $('#cropmanagementList').DataTable({
    serverSide: true,
    processing: true,
    responsive: true,
    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
    language: {
        lengthMenu: '<select class="form-select">'+
                        '<option value="10">10</option>'+
                        '<option value="25">25</option>'+
                        '<option value="50">50</option>'+
                        '<option value="100">100</option>'+
                    '</select>'
    },
    buttons: [
        {
            extend: 'collection',
            text: '<i class="bi bi-download"></i>',
            className: 'btn btn-light dropdown-toggle',
            buttons: [
                {
                    extend: 'csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: [0, 1, 2, 3] }
                },
                {
                    extend: 'excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: [0, 1, 2, 3] }
                },
                {
                    extend: 'pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: [0, 1, 2, 3] }
                },
                {
                    extend: 'print',
                    className: 'dropdown-item',
                    exportOptions: { columns: [0, 1, 2, 3] }
                }
            ]
        }
    ],
    ajax: {
        url: cropmanagementUrl
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'crop_name', name: 'crop_name' },
        { data: 'planating_date', name: 'planating_date' },
        { data: 'harvesting_start_date', name: 'harvesting_start_date' },
        { data: 'harvesting_end_date', name: 'harvesting_end_date' },
        { data: 'expected_price', name: 'expected_price' },
        { data: 'inquiry_count', name: 'inquiry_count', orderable: false, searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]

});
}

});
