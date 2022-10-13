"use strict";

const transaksiList = function () {
    let table = document.querySelector('#transaksiTable');
    let datatable ;
    let toolbarBase;
    let toolbarSelected;
    let selectedCount;
    let isPicIt = document.querySelector('#isPic').value;
    let isPicUmum = document.querySelector('#isPicUmum').value;
    const initTransaksiTable = () => {
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/OrderController/transaksiList` ,
                "dataSrc" : "",
            },
            'dom': 'Brtip',
            "scrollX": true,
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'id'},
                {"data" : 'tanggal'},
                {"data" : 'nama'},
                {"data" : 'tipe'},
                {"data" : 'unitkerja'},
                {"data" : 'status'},
                {"data" : 'dokumen'},
                {"data" : 'status'},
                
            ],
            'order': [[1, 'desc']],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data, type, row) {
                        if (row['linked'] > 0) {
                            return `<div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input disabled class="form-check-input" type="checkbox" value="${data}" />
                                    </div>`;
                        } else {
                            return `<div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input aktif" type="checkbox" value="${data}" />
                                    </div>`;
                        }

                    },
                },
                {
                    targets: 6,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `
                                    <a href="/Data/transaksi/${row['id']}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-3">
                                    <i class="fas fa-eye"></i>
                                    </span>
                                    <!--end::Svg Icon-->
                                    </a>
                                    <a href="/Data/transaksi/${row['id']}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-3">
                                    <i class="fas fa-history"></i>
                                    </span>
                                    <!--end::Svg Icon-->
                                    </a>
                                    <a href="/Cetak/${row['id']}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-3">
                                    <i class="fas fa-download"></i>
                                    </span>
                                    <!--end::Svg Icon-->
                                    </a>
                                `;
                    },
                },
                {
                    targets: 7,
                    orderable: false,
                    render: function (data, type, row) {
                        if (data == 'Berhasil' && row['tipe'] == 'Penggunaan') {
                            return `<span class="badge badge-light-success">Disetujui</span>`
                        } else if(data == 'Berhasil' && row['tipe'] != 'Penggunaan'){
                            return `<span class="badge badge-light-primary">Berhasil</span>`;
                        } else if(data == 'Ditolak' && row['tipe'] == 'Penggunaan'){
                            return `<span class="badge badge-light-danger">Ditolak</span>`
                        } else if(data == 'Belum di Approve' && row['tipe'] == 'Penggunaan'){
                            if (isPicIt == true && row['dokumen'] == 'IT') {
                                return `<a href="/Approve/${row['id']}" class="badge badge-light-success">Approve</a>
                                        <a href="#" class="badge badge-light-danger tolakTransaksi">Tolak</a>
                                        `;
                                        //<span class="badge badge-light-warning">In Progress</span>
                            } else if(isPicIt != true && row['dokumen'] == 'IT'){
                                return `<span class="badge badge-light-warning">In Progress</span>`
                            } else if(isPicUmum == true && row['dokumen'] == 'Umum'){
                                return `<a href="/Approve/${row['id']}" class="badge badge-light-success">Approve</a>
                                        <a href="#" class="badge badge-light-danger tolakTransaksi">Tolak</a>
                                        `;
                                        //<span class="badge badge-light-warning">In Progress</span>
                            }else {
                                return `<span class="badge badge-light-warning">In Progress</span>`
                            }
                        } 
                    },
                },
            ]
        });

        datatable.on('draw', function () {

        });
    }

   

    const handleTolakTransaksi = () => {
        datatable.on('click', '.tolakTransaksi' , (e) => {
            e.preventDefault()
            let tr = e.target.closest('tr');
            let td = tr.querySelectorAll('td');         
            let id = td[0].children[0].children[0].value;
            if (id != null || id != '') {
                Swal.fire({
                    text: "Alasan Penolakan ?",
                    input: 'text',
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "Submit!",
                    cancelButtonText: "Batal",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    },
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        console.log(login);
                        return  fetch(`/OrderController/tolak/${id}`, {
                                    method : "POST",
                                    body : JSON.stringify({login}),
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-Requested-With": "XMLHttpRequest"
                                    },
                                })
                                .catch(error => {
                                    Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                    )
                                })
                    }
                }).then(function (result) {
                    if (result.isConfirmed) {
                        location.assign('/Data/Transaksi');
                    }
                });
            }
        })
    }

    const handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-transaksi-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    const handleFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-transaksi-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-transaksi-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll('select');

        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            var filterString = '';

            // Get filter values
            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += ' ';
                    }

                    // Build filter value options
                    filterString += item.value;
                }
            });

            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search(filterString).draw();
        });
    }

    const handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-transaksi-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-transaksi-table-filter="form"]');
            const selectOptions = filterForm.querySelectorAll('select');

            // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
            selectOptions.forEach(select => {
                $(select).val('').trigger('change');
            });

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search('').draw();
        });
    }

    // 

    return {
        // Public functions  
        init: () => {
            if (!table) {
                return;
            }

            initTransaksiTable();
            // initToggleToolbar();
            handleSearchDatatable();
            handleResetForm();
            handleTolakTransaksi();
            // handleDeleteRows();
            handleFilterDatatable();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    transaksiList.init();
});