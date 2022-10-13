"use strict";

const handleDetailDepartemen = function() {
    const form = document.querySelector('#edit_departemen_form');
    let id = form.id_departemen.value;
    let table = document.querySelector('#departemenHistoryTable');
    let datatable;
    const initHistoryDepartemenTable = () => {
        
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/departemenHistoryList/${id}` ,
                "dataSrc" : "",
            },
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'created_at'},
                {"data" : 'description'},
                {"data" : 'before'},
                {"data" : 'after'},
                {"data" : 'created_by'},

            ],
            
        });

        datatable.on('draw', function () {
           
        });
    }

    const handleHistoryFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-departemen-history-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-departemen-history-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-departemen-history-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-departemen-history-table-filter="form"]');
            const selectOptions = filterForm.querySelectorAll('select');

            // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
            selectOptions.forEach(select => {
                $(select).val('').trigger('change');
            });

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search('').draw();
        });
    }

    const handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-departemen-history-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    const handleurl = () => {
        let filterButton = document.querySelector('[data-kt-departemen-detail-filter="filter"]');
        let selectOptions = document.querySelector('#selectdepartemen');
        filterButton.addEventListener('click', () => {
            if (selectOptions.value && selectOptions.value !== '') {
                location.assign(`/Company/departemen/${selectOptions.value}`);
            }
        })
    }

    const handleEditDepartemen = () => {
        let viewDepartemen = document.querySelector('[data-unique="viewDepartemen"]');
        let editDepartemen = document.querySelector('[data-unique="editDepartemen"]');
        let buttonEdit = document.querySelector('[data-unique="edit"]');
        let tempDiv = document.querySelector('[data-unique="tempDiv"]');
        let buttonCancel = document.querySelector('[data-unique="cancel"]');



        buttonEdit.addEventListener('click', () => {
            buttonEdit.classList.add('d-none');
            tempDiv.classList.remove('d-none');
            viewDepartemen.classList.add('d-none');
            editDepartemen.classList.remove('d-none');
        });

        buttonCancel.addEventListener('click', () => {
            buttonEdit.classList.remove('d-none');
            tempDiv.classList.add('d-none');;
            viewDepartemen.classList.remove('d-none');
            editDepartemen.classList.add('d-none');
        });        
    }

    const initEditDepartemen = () => {
        const submitButton = document.querySelector('[data-unique="save"]');
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'editDepartemenName': {
                        validators: {
                            notEmpty: {
                                message: 'Departemen name is required'
                            }
                        }
                    },
                    'editDepartemenUnitkerja': {
                        validators: {
                            notEmpty: {
                                message: 'Departemen Unitkerja is required'
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


        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let editDepartemenName = form.editDepartemenName.value;
            let editstatus = document.querySelector("input[type='radio'][name=editDepartemenStatus]:checked").value;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        try {
                            fetch('/CompanyController/departemenUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, editDepartemenName, editstatus}),
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-Requested-With": "XMLHttpRequest"
                                },
                            }).catch(error => {
                                console.error('There was an error!', error);
                            });
                            setTimeout(function () {
                                // Remove loading indication
                                submitButton.removeAttribute('data-kt-indicator');
    
                                // Enable button
                                submitButton.disabled = false;
    
                                // Show popup confirmation 
                                Swal.fire({
                                    text: "Data Departemen Berhasil Diubah!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    allowOutsideClick: false,
                                    confirmButtonText: "Ok, Mengerti!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        // modal.hide();
                                        location.assign(`/Company/departemen/${id}`);
                                    }
                                });
    
                                //form.submit(); // Submit form
                            }, 2000);
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


        })


    }
    

    return {
        // Public functions
        init: function () {
            handleurl();
            handleEditDepartemen();
            initEditDepartemen();
            initHistoryDepartemenTable();
            handleSearchDatatable();
            handleHistoryFilterDatatable();
            handleResetForm();
        }
    };
}();

const handleLinkedDepartemen = function() {
    const form = document.querySelector('#edit_departemen_form');
    let id = form.id_departemen.value;
    
    const initJabatanLinkedDepartemenTable= () => {
        let table = document.querySelector('#departemenJabatanTable');
        let datatable;
        let title = document.querySelector('#linked-departemen-title');

        title= 'Departemen Terhubung';

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/jabatanInDepartemen/${id}` ,
                "dataSrc" : "",
            },
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'content'},
                {"data" : 'unitkerja'},
                {"data" : 'status_dep'},
            ],
            
        });

        datatable.on('draw', function () {
           
        });
    }

    const initKaryawanLinkedDepartemenTable= () => {
        let table = document.querySelector('#departemenKaryawanTable');
        let datatable;
        let title = document.querySelector('#linked-departemen-title');

        title= 'Karyawan Terhubung';

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/karyawanInDepartemen/${id}` ,
                "dataSrc" : "",
            },
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'nama'},
                {"data" : 'nrp'},
                {"data" : 'content'},
                {"data" : 'email'},
                {"data" : 'is_pic'},
            ],
            
        });

        datatable.on('draw', function () {
           
        });
    }


    const handleLinkedFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-departemen-linked-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-departemen-linked-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll('select');
        const jabatanTable = document.querySelector('[data-unique="departemenJabatanTable"]');
        const karyawanTable = document.querySelector('[data-unique="departemenKaryawanTable"]');
        let title = document.querySelector('#linked-departemen-title');
        let filterString = '';
        title.innerHTML = 'Karyawan Terhubung';
        karyawanTable.classList.remove('d-none');
        // initRuanganLinkedRuanganTable();
        initJabatanLinkedDepartemenTable();
        initKaryawanLinkedDepartemenTable();
        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += '';
                    }
                    filterString = item.value;
                }
            });

            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            // datatable.search(filterString).draw();

            if (filterString == '' ||filterString == 'Karyawan') {
                title.innerHTML = 'Karyawan Terhubung';
                // departemenTable.classList.add('d-none');
                karyawanTable.classList.remove('d-none');
                jabatanTable.classList.add('d-none');
            }
            if (filterString == 'Jabatan') {
                title.innerHTML = 'Jabatan Terhubung';
                // departemenTable.classList.add('d-none');
                karyawanTable.classList.add('d-none');
                jabatanTable.classList.remove('d-none');
            }
        });
    }



    return {
        init: function () {
            handleLinkedFilterDatatable();
        }
    }
}();




KTUtil.onDOMContentLoaded(function () {
    handleDetailDepartemen.init();
    handleLinkedDepartemen.init();
});