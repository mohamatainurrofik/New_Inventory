"use strict";

const kriteriaList = function () {
    let table = document.querySelector('#kriteriaTable');
    let datatable ;
    let toolbarBase;
    let toolbarSelected;
    let selectedCount;
    const element = document.getElementById('kt_modal_edit_kriteria');
    const editForm = element.querySelector('#kt_modal_edit_kriteria_form');
    const modal = new bootstrap.Modal(element);

    const initKriteriaTable = () => {
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/AlgorithmController/kriteriaList` ,
                "dataSrc" : "",
            },
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'id'},
                {"data" : 'kode'},
                {"data" : 'nama'},
                {"data" : 'atribut'},
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
                                        <input disabled class="form-check-input aktif" type="checkbox" value="${data}" />
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
                                    <a data-bs-toggle="modal" data-bs-target="#kt_modal_edit_kriteria" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 editKriteria">
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

    const handleEditKriteria = () => {

        datatable.on('click', '.editKriteria' , (e) => {
            e.preventDefault()
            let tr = e.target.closest('tr');
            let td = tr.querySelectorAll('td');         

            let idKriteria = editForm.editkriteria_id;
            let nameKriteria = editForm.editkriteria_name;
            let kodeKriteria = editForm.editkriteria_kode;
            let attributKriteria =  document.querySelector("input[type='radio'][name=editkriteria_atribut][value="+td[3].innerHTML+"]");


            idKriteria.value = td[0].children[0].children[0].value;
            nameKriteria.value = td[2].innerHTML;
            kodeKriteria.value = td[1].innerHTML;
            attributKriteria.checked = true;


        })

        let validator = FormValidation.formValidation(
            editForm,
            {
                fields: {
                    'editkriteria_name': {
                        validators: {
                            notEmpty: {
                                message: 'Kriteria name is required'
                            }
                        }
                    },
                    'editkriteria_kode': {
                        validators: {
                            notEmpty: {
                                message: 'Kriteria kode is required'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );


        const submitButton = element.querySelector('[data-kt-editkriteria-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let kriteria_id = editForm.editkriteria_id.value;
            let kriteria_name = editForm.editkriteria_name.value;
            let kriteria_kode = editForm.editkriteria_kode.value;
            let kriteria_atribut = document.querySelector("input[type='radio'][name=editkriteria_atribut]:checked").value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        try {
                            fetch('/AlgorithmController/kriteriaUpdate',{
                                method : "POST",
                                body : JSON.stringify({kriteria_name, kriteria_kode, kriteria_atribut, kriteria_id}),
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-Requested-With": "XMLHttpRequest"
                                },
                            })
                            .then((response) => response.json())
                            .then((data) => {
                                setTimeout(function () {
                                    // Remove loading indication
                                    submitButton.removeAttribute('data-kt-indicator');
        
                                    // Enable button
                                    submitButton.disabled = false;
        
                                    // Show popup confirmation 
                                    if (data) {
                                        Swal.fire({
                                            text: "Data Kriteria Berhasil Diubah!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, Mengerti!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                modal.hide();
                                                location.assign('/Fahp/kriteria');
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            text: "Sorry, Kode Kriteria Sudah Ada.!",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, Mengerti!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                // modal.hide();
                                                // location.assign('/Company/unitkerja');
                                            }
                                        });
                                    }
                                }, 2000);
                            });

                        } catch (error) {
                            console.log(error);
                        }


                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/

                    } else {
                        // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Sorry, Seperti Ada Error yang Terdeteksi, Silahkan Coba Lagi.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-editkriteria-modal-action="cancel"]');
        cancelButton.addEventListener('click', e => {
            e.preventDefault();

           Swal.fire({
                text: "Apakah Kamu Yakin Ingin Membatalkan ?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Batalkan!",
                cancelButtonText: "Tidak, Kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    editForm.reset(); // Reset form			
                    modal.hide();	
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Form Anda Belum Dibatalkan!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-editkriteria-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

           Swal.fire({
                text: "Apakah Kamu Yakin Ingin Membatalkan ?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Batalkan!",
                cancelButtonText: "Tidak, Kembali",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    editForm.reset(); // Reset form			
                    modal.hide();	
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Form Anda Belum Dibatalkan!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    const handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-kriteria-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    const handleFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-kriteria-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-kriteria-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-kriteria-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-kriteria-table-filter="form"]');
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
        const deleteButtons = table.querySelectorAll('[data-kt-kriteria-table-filter="delete_row"]');

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
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Tidak, Batal",
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
                            confirmButtonText: "Ok, Mengerti!",
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
                            confirmButtonText: "Ok, Mengerti!",
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
        toolbarBase = document.querySelector('[data-kt-kriteria-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-kriteria-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-kriteria-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-kriteria-table-select="delete_selected"]');

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
                text: "Yakin ingin menghapus kriteria yang dipilih ?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Tidak, Batal",
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
                        fetch('/AlgorithmController/kriteriaDelete',{
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
                                text: "Berhasil menghapus seluruh kriteria yang dipilih!.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, Mengerti!",
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
                        text: "Kriteria yang dipilih tidak terhapus!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Mengerti!",
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

            initKriteriaTable();
            initToggleToolbar();
            handleSearchDatatable();
            handleResetForm();
            handleDeleteRows();
            handleFilterDatatable();
            handleEditKriteria();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    kriteriaList.init();
});