$(document).ready(function () {
    // category Table List
    if ($(".categorylist").length) {
        $(".categorylist").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                    ],
                },
            ],
            ajax: {
                url: catergoryUrl,
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "category_name",
                    name: "category_name",
                    render: function (data, type, row) {
                        return data.charAt(0).toUpperCase() + data.slice(1);
                    },
                },
                { data: "description", name: "description" },
                { data: "status", name: "status" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

// payment gateway list table
$(document).ready(function () {
    if ($(".paymentgatewaylist").length) {
        $(".paymentgatewaylist").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                    ],
                },
            ],
            ajax: {
                url: paymentgatewayUrl,
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },

                { data: "api_key", name: "api_key" },
                { data: "secret_key", name: "secret_key" },
                { data: "payment", name: "payment" },
                { data: "status", name: "status" },

                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

///SMS Gategay list table
$(document).ready(function () {
    if ($(".smsList").length) {
        $(".smsList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                    ],
                },
            ],
            ajax: {
                url: smsgatewayUrl,
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },

                { data: "api_key", name: "api_key" },
                { data: "status", name: "status" },

                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

///whatsapp list table
$(document).ready(function () {
    if ($(".whatsappList").length) {
        $(".whatsappList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                    ],
                },
            ],
            ajax: {
                url: whatsappUrl,
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },

                { data: "api_key", name: "api_key" },
                { data: "status", name: "status" },

                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

///unitmass (qualitymass)
$(document).ready(function () {
    if ($(".quantityMassList").length) {
        $(".quantityMassList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                    ],
                },
            ],
            ajax: {
                url: quantityMassUrl,
            },
            order: [[1, "asc"]],
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },

                {
                    data: "name",
                    name: "name",
                    render: function (data, type, row) {
                        return data.charAt(0).toUpperCase() + data.slice(1);
                    },
                },
                { data: "description", name: "description" },
                { data: "status", name: "status" },

                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

///role list table
$(document).ready(function () {
    if ($(".roleList").length) {
        $(".roleList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                    ],
                },
            ],
            ajax: {
                url: roleUrl,
            },
            order: [[1, "asc"]],
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },

                {
                    data: "name",
                    name: "name",
                    render: function (data, type, row) {
                        return data.charAt(0).toUpperCase() + data.slice(1);
                    },
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

///permission list table
$(document).ready(function () {
    if ($(".permissionList").length) {
        $(".permissionList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                    ],
                },
            ],
            ajax: {
                url: permissionUrl,
            },
            order: [[1, "asc"]],
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },

                {
                    data: "name",
                    name: "name",
                    render: function (data, type, row) {
                        return data.charAt(0).toUpperCase() + data.slice(1);
                    },
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

////user list
$(document).ready(function () {
    if ($(".userList").length) {
        $(".userList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                    ],
                },
            ],
            ajax: {
                url: userUrl,
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                { data: "name", name: "name" },
                { data: "email", name: "email" },
                {
                    data: "roles",
                    name: "roles",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

///wallet point table list

$(document).ready(function () {
    if ($(".walletpointList").length) {
        $(".walletpointList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                    ],
                },
            ],
            ajax: {
                url: walletpointUrl,
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                { data: "points_per_inquiry", name: "points_per_inquiry" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

///referral point list table

$(document).ready(function () {
    if ($(".referralpointList").length) {
        $(".referralpointList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                    ],
                },
            ],
            ajax: {
                url: referralpointUrl,
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                { data: "referral_points", name: "referral_points" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

////farmer list table
$(document).ready(function () {
    if ($(".farmerList").length) {
        $(".farmerList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                    ],
                },
            ],
            ajax: {
                url: farmerListUrl, // define this variable or write route URL directly
                data: function (d) {
                    d.solar_dryer = $("#solarDryerFilter").val();
                    d.search = $("#searchInput").val();
                },
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                { data: "name", name: "name" },
                { data: "email", name: "email" },
                { data: "phone", name: "phone" },
                { data: "solar_dryer", name: "solar_dryer" },
                {
                    data: "documents",
                    name: "documents",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });

        $("#solarDryerFilter, #searchInput").on("change keyup", function () {
            $(".farmerList").DataTable().draw();
        });
    }
});
// Handle document view
$(document).on("click", ".view-document-btn", function () {
    const docUrl = $(this).data("url");
    $("#documentIframe").attr("src", docUrl);
    $("#viewDocumentModal").modal("show");
});

////cms page list table

$(document).ready(function () {
    if ($(".cmsList").length) {
        $(".cmsList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="200">200</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                    ],
                },
            ],
            ajax: {
                url: cmsUrl,
            },
            order: [[1, "asc"]],
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },

                {
                    data: "title",
                    name: "title",
                    render: function (data, type, row) {
                        return data.charAt(0).toUpperCase() + data.slice(1);
                    },
                },
                { data: "summary", name: "summary" },

                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }
});

///faq category  table list
$(document).ready(function () {
    if ($(".faqcategoryList").length) {
        $(".faqcategoryList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: faqcategoryUrl,
            },
            order: [[1, "asc"]],
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "description",
                    name: "description",
                },
                {
                    data: "status",
                    name: "status",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3] },
                        },
                    ],
                },
            ],
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    "</select>",
            },
        });
    }
});

///faq table list
$(document).ready(function () {
    if ($(".faqList").length) {
        $(".faqList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: faqUrl,
            },
            order: [[1, "asc"]],
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "faqcategory.name",
                    name: "faqcategory.name",
                    render: function (data) {
                        return data
                            ? data.charAt(0).toUpperCase() + data.slice(1)
                            : "";
                    },
                },
                {
                    data: "question",
                    name: "question",
                },
                {
                    data: "answer",
                    name: "answer",
                },
                {
                    data: "status",
                    name: "status",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4] },
                        },
                    ],
                },
            ],
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    "</select>",
            },
        });
    }
});
///crop list table

$(document).ready(function () {
    if ($(".cropList").length) {
        $(".cropList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: cropUrl,
            },
            order: [[1, "asc"]],
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                { data: "crop_name", name: "crop_name" },
                { data: "planating_date", name: "planating_date" },
                {
                    data: "harvesting_start_date",
                    name: "harvesting_start_date",
                },
                { data: "harvesting_end_date", name: "harvesting_end_date" },
                { data: "expected_price", name: "expected_price" },
                { data: "inquiry", name: "inquiry" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: ":visible" },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: ":visible" },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: ":visible" },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: ":visible" },
                        },
                    ],
                },
            ],
        });
    }
});
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

///wallet table(member panel)
$(document).ready(function () {
    if ($(".walletList").length) {
        $(".walletList").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: walletUrl,
            },
            order: [[1, "asc"]],
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "wallet_name",
                    name: "wallet_name",
                },
                {
                    data: "balance",
                    name: "balance",
                },
            ],
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2] },
                        },
                    ],
                },
            ],
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    "</select>",
            },
        });
    }
});

/////Crop Management List
if ($("#cropmanagementList").length) {
    $("#cropmanagementList").DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        rowReorder: {
            selector: "td:nth-child(2)",
        },
        dom:
            "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
        language: {
            lengthMenu:
                '<select class="form-select">' +
                '<option value="10">10</option>' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="100">100</option>' +
                "</select>",
        },
        buttons: [
            {
                extend: "collection",
                text: '<i class="bi bi-download"></i>',
                className: "btn btn-light dropdown-toggle",
                buttons: [
                    {
                        extend: "csv",
                        className: "dropdown-item",
                        exportOptions: { columns: [0, 1, 2, 3] },
                    },
                    {
                        extend: "excel",
                        className: "dropdown-item",
                        exportOptions: { columns: [0, 1, 2, 3] },
                    },
                    {
                        extend: "pdf",
                        className: "dropdown-item",
                        exportOptions: { columns: [0, 1, 2, 3] },
                    },
                    {
                        extend: "print",
                        className: "dropdown-item",
                        exportOptions: { columns: [0, 1, 2, 3] },
                    },
                ],
            },
        ],
        ajax: {
            url: cropmanagementUrl,
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "crop_name", name: "crop_name" },
            { data: "planating_date", name: "planating_date" },
            { data: "harvesting_start_date", name: "harvesting_start_date" },
            { data: "harvesting_end_date", name: "harvesting_end_date" },
            { data: "expected_price", name: "expected_price" },
            {
                data: "inquiry_count",
                name: "inquiry_count",
                orderable: false,
                searchable: false,
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
}

////crop  inquiry table list
$(document).ready(function () {
    if ($("#inquiryTable").length) {
        $("#inquiryTable").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: inquiryUrl, // Adjust this route as needed
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                },
                { data: "name", name: "name" },
                { data: "email", name: "email" },
                { data: "mobile_number", name: "mobile_number" },
                { data: "description", name: "description" },
                { data: "city", name: "city" },
            ],
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                    ],
                },
            ],
        });
    }
});
//// my enquiry details list table
$(document).ready(function () {
    if ($("#inquiriesTable").length) {
        $("#inquiriesTable").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: myinquiriesUrl,
            },
            columns: [
                {
                    data: null,
                    name: "id",
                    render: function (data, type, row, meta) {
                        // Display sequential ID based on row index
                        return meta.row + 1; // Adding 1 to make it start from 1
                    },
                },
                { data: "crop_name", name: "cropManagement.crop_name" },
                { data: "farmer_name", name: "cropManagement.farmer.name" },
                { data: "mobile", name: "cropManagement.farmer.phone" },
                { data: "email", name: "cropManagement.farmer.email" },
                // { data: "state", name: "cropManagement.farmer.state" },
                { data: "city", name: "cropManagement.farmer.city" },
                { data: "date", name: "created_at" },
                { data: "wallet", orderable: false, searchable: false },
            ],
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                    ],
                },
            ],
        });
    }
});

//district table
$(document).ready(function () {
    if ($("#districtsTable").length) {
        $("#districtsTable").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: districtUrl, // Replace with your server-side URL for fetching data
                type: "GET",
            },
            columns: [
                {
                    data: null,
                    name: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Display sequential ID based on row index
                    },
                },

                { data: "district_name", name: "district_name" },
                { data: "state_name", name: "states.name" },
                { data: "district_code", name: "district_code" }, // Assuming you have a 'state_name' field
                { data: "status", name: "status" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                    ],
                },
            ],
        });
    }
});

///taluka table
$(document).ready(function () {
    if ($("#talukasTable").length) {
        $("#talukasTable").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: talukaUrl,
                type: "GET",
            },
            columns: [
                {
                    data: null,
                    name: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    },
                },

                { data: "taluka_name", name: "taluka_name" },
                { data: "district_name", name: "district.district_name" },
                { data: "taluka_code", name: "taluka_code" },
                { data: "status", name: "status" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="500">500</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
                        },
                    ],
                },
            ],
        });
    }
});

///village table list
$(document).ready(function () {
    if ($("#villagesTable").length) {
        $("#villagesTable").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: villageUrl, // Ensure this returns JSON when AJAX
                type: "GET",
            },
            columns: [
                {
                    data: null,
                    name: "id",
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    },
                },

                { data: "village_name", name: "village_name" },
                { data: "taluka_name", name: "taluka.taluka_name" },
                { data: "village_code", name: "village_code" },
                { data: "status", name: "status" },
                { data: "village_category", name: "village_category" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            dom:
                "<'row mb-3'<'col-sm-4'l><'col-sm-8 d-flex justify-content-end align-items-center gap-2'fB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row mt-2'<'col-sm-6'i><'col-sm-6 d-flex justify-content-end'p>>",
            language: {
                lengthMenu:
                    '<select class="form-select">' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    '<option value="500">500</option>' +
                    "</select>",
            },
            buttons: [
                {
                    extend: "collection",
                    text: '<i class="bi bi-download"></i>',
                    className: "btn btn-light dropdown-toggle",
                    buttons: [
                        {
                            extend: "csv",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
                        },
                        {
                            extend: "excel",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
                        },
                        {
                            extend: "pdf",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
                        },
                        {
                            extend: "print",
                            className: "dropdown-item",
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
                        },
                    ],
                },
            ],
        });
    }
});

////farmer list table

///delete button
$(document).on("click", ".delete-confirm", function (e) {
    e.preventDefault();
    const url = $(this).attr("href");
    Swal.fire({
        title: "Are you sure?",
        text: "This Data will be deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085D6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
});
