"use strict";

const jabatanList = function () {
    let table = document.querySelector('#jabatanTable');
    let datatable ;
    let toolbarBase;
    let toolbarSelected;
    let selectedCount;
    let selectJabatanFilter = $('[data-kt-jabatan-table-filter="ruangan"]');

    const initjabatanTable = () => {

        selectJabatanFilter.select2({
            ajax : {
                url : '/CompanyController/listRuanganSelect2/',
                type: 'POST',
                dataType : 'json',
                data: function(params)
                {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data
                    };
                }
            },
        });

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/jabatanList` ,
                "dataSrc" : "",
            },
            'dom': 'Brtip',
            "scrollX": true,
            'order': [[3, 'ASC']],
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'id'},
                {"data" : 'nama'},
                {"data" : 'unitkerja'},
                {"data" : 'status'},
                {"data" : 'linked'},

            ],
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
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        return `
                                    <a href="/Company/jabatan/${row['id']}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    </a>
                                `;
                    },
                },
            ]
        });

        datatable.on('draw', function () {
            initToggleToolbar();
            handleDeleteRows();
            toggleToolbars();
        });
    }



    const handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-jabatan-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    const handleFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-jabatan-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-jabatan-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll('select');

        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            var filterString = '';

            // Get filter values
            filterString = selectJabatanFilter.find(':selected').text();
            console.log(filterString);
            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search(filterString).draw();
        });
    }

    const handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-jabatan-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-jabatan-table-filter="form"]');
            const selectOptions = filterForm.querySelectorAll('select');

            // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
            selectOptions.forEach(select => {
                $(select).val('').trigger('change');
            });

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search('').draw();
        });
    }

    const handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-jabatan-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get user name
                const userName = parent.querySelectorAll('td')[1].querySelectorAll('a')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + userName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            text: "You have deleted " + userName + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            // Remove current row
                            datatable.row($(parent)).remove().draw();
                        }).then(function () {
                            // Detect checked checkboxes
                            toggleToolbars();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: customerName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    const initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');
        var data = [];
        
        // Select elements
        toolbarBase = document.querySelector('[data-kt-jabatan-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-jabatan-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-jabatan-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-jabatan-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Yakin ingin menghapus jabatan yang dipilih ?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    checkboxes.forEach(c => {
                        if (c.checked) {
                            datatable.row($(c.closest('tbody tr'))).remove().draw();
                            data.push({'id' : c.value});
                        }
                    });
                    
                    console.log(JSON.stringify(data));
                    try {
                        fetch('/CompanyController/jabatanDelete',{
                            method : "POST",
                            body : JSON.stringify(data) ,
                            headers: {
                                "Content-Type": "application/json",
                                "X-Requested-With": "XMLHttpRequest"
                            },
                        })
                        .catch((error) => {
                          console.error('Error:', error);
                        });
                        setTimeout(function () {
                            Swal.fire({
                                text: "Berhasil menghapus seluruh jabatan yang dipilih!.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                                headerCheckbox.checked = false;
                            }).then(function () {
                                toggleToolbars(); // Detect checked checkboxes
                                initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                            });
                        }, 50);
                        
                    } catch (error) {
                        console.log(error);
                    }
                    
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "jabatan yang dipilih tidak terhapus!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    const toggleToolbars = () => {
        // Select refreshed checkbox DOM elements 
        const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    return {
        // Public functions  
        init: () => {
            if (!table) {
                return;
            }

            initjabatanTable();
            initToggleToolbar();
            handleSearchDatatable();
            handleResetForm();
            handleDeleteRows();
            handleFilterDatatable();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    jabatanList.init();
});