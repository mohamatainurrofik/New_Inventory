"use strict";

const handleDetailUnitkerja = function() {
    const form = document.querySelector('#edit_unitkerja_form');
    let id = form.id_unitkerja.value;
    let table = document.querySelector('#unitkerjaHistoryTable');
    let datatable;
    
    const initHistoryUnitkerjaTable = () => {
        
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/unitkerjaHistoryList/${id}` ,
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
        const filterForm = document.querySelector('[data-kt-unitkerja-history-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-unitkerja-history-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-unitkerja-history-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-unitkerja-history-table-filter="form"]');
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
        const filterSearch = document.querySelector('[data-kt-unitkerja-history-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    const handleurl = () => {
        let filterButton = document.querySelector('[data-kt-unitkerja-detail-filter="filter"]');
        let selectOptions = document.querySelector('#selectunitkerja');
        filterButton.addEventListener('click', () => {
            if (selectOptions.value && selectOptions.value !== '') {
                location.assign(`/Company/unitkerja/${selectOptions.value}`);
            }
        })
    }

    const handleEditUnitkerja = () => {
        let viewUnitkerja = document.querySelector('[data-unique="viewUnitkerja"]');
        let editUnitkerja = document.querySelector('[data-unique="editUnitkerja"]');
        let buttonEdit = document.querySelector('[data-unique="edit"]');
        let tempDiv = document.querySelector('[data-unique="tempDiv"]');
        let buttonCancel = document.querySelector('[data-unique="cancel"]')

        buttonEdit.addEventListener('click', () => {
            buttonEdit.classList.add('d-none');
            tempDiv.classList.remove('d-none');
            viewUnitkerja.classList.add('d-none');
            editUnitkerja.classList.remove('d-none');
        });

        buttonCancel.addEventListener('click', () => {
            buttonEdit.classList.remove('d-none');
            tempDiv.classList.add('d-none');;
            viewUnitkerja.classList.remove('d-none');
            editUnitkerja.classList.add('d-none');
        });        
    }

    const initEditUnitkerja = () => {
        const submitButton = document.querySelector('[data-unique="save"]');
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'editUnitkerjaName': {
                        validators: {
                            notEmpty: {
                                message: 'Unitkerja name is required'
                            }
                        }
                    },
                    'editUnitkerjaKode': {
                        validators: {
                            notEmpty: {
                                message: 'Unitkerja kode is required'
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
            let editUnitkerjaName = form.editUnitkerjaName.value;
            let editUnitkerjaKode = form.editUnitkerjaKode.value;
            let editstatus = document.querySelector("input[type='radio'][name=editUnitkerjaStatus]:checked").value;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        console.log(editstatus);
                        try {
                            fetch('/CompanyController/unitkerjaUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, editUnitkerjaName, editUnitkerjaKode, editstatus}),
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
                                    if (data) {
                                        Swal.fire({
                                            text: "Data Unitkerja Berhasil Diubah!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, Mengerti!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                // modal.hide();
                                                location.assign(`/Company/unitkerja/${id}`);
                                            }
                                        });
                                    }else{
                                        Swal.fire({
                                            text: "Sorry, Email atau Username Sudah Ada.!",
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
                            }).catch(error => {
                                console.error('There was an error!', error);
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


        })


    }
    

    return {
        // Public functions
        init: function () {
            handleurl();
            handleEditUnitkerja();
            initEditUnitkerja();
            initHistoryUnitkerjaTable();
            handleSearchDatatable();
            handleHistoryFilterDatatable();
            handleResetForm();
        }
    };
}();

const handleLinkedUnitkerja = function() {
    const form = document.querySelector('#edit_unitkerja_form');
    let id = form.id_unitkerja.value;
    
    const initRuanganLinkedUnitkerjaTable = () => {
        let table = document.querySelector('#unitkerjaRuanganTable');
        let datatable;
        
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/unitkerjaLinked/${id}` ,
                "dataSrc" : "",
            },
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'kode_unitkerja'},
                {"data" : 'unitkerja'},
                {"data" : 'status_unitkerja'},
            ],
            
        });

        datatable.on('draw', function () {
           
        });
    }

    const initKaryawanLinkedUnitkerjaTable= () => {
        let table = document.querySelector('#unitkerjaKaryawanTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/karyawanInUnitkerja/${id}` ,
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

    const initAsetLinkedUnitkerjaTable= () => {
        let table = document.querySelector('#unitkerjaInventarisTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/asetInUnitkerja/${id}` ,
                "dataSrc" : "",
            },
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'kode'},
                {"data" : 'content_product'},
                {"data" : 'nama_unit'},
                {"data" : 'brand'},
                {"data" : 'jenis_product'},
                {"data" : 'nama'},
                {"data" : 'status_unit'},
            ],
            
        });

        datatable.on('draw', function () {
           
        });
    }

    const handleLinkedFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-unitkerja-linked-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-unitkerja-linked-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll('select');
        const ruanganTable = document.querySelector('[data-unique="unitkerjaRuanganTable"]');
        const karyawanTable = document.querySelector('[data-unique="unitkerjaKaryawanTable"]');
        const inventarisTable = document.querySelector('[data-unique="unitkerjaInventarisTable"]');
        let title = document.querySelector('#linked-unitkerja-title');
        let filterString = '';
        title.innerHTML = 'Ruangan Terhubung';
        ruanganTable.classList.remove('d-none');
        initRuanganLinkedUnitkerjaTable();
        initKaryawanLinkedUnitkerjaTable();
        initAsetLinkedUnitkerjaTable();
        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += ' ';
                    }

                    // Build filter value options
                    filterString = item.value;
                    console.log(filterString);
                }
            });

            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            // datatable.search(filterString).draw();
            if (filterString == '' || filterString == 'Ruangan') {
                title.innerHTML = 'Ruangan Terhubung';
                ruanganTable.classList.remove('d-none');
                karyawanTable.classList.add('d-none');
                inventarisTable.classList.add('d-none');
            }
            if (filterString == 'Karyawan') {
                title.innerHTML = 'Karyawan Terhubung';
                ruanganTable.classList.add('d-none');
                karyawanTable.classList.remove('d-none');
                inventarisTable.classList.add('d-none');
            }
            if (filterString == 'Inventaris') {
                title.innerHTML = 'Inventaris Terhubung';
                ruanganTable.classList.add('d-none');
                karyawanTable.classList.add('d-none');
                inventarisTable.classList.remove('d-none');
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
    handleDetailUnitkerja.init();
    handleLinkedUnitkerja.init();
});