"use strict";

const handleDetailRuangan = function() {
    const form = document.querySelector('#edit_ruangan_form');
    let id = form.id_ruangan.value;
    let table = document.querySelector('#ruanganHistoryTable');
    let datatable;
    const initHistoryRuanganTable = () => {
        
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
        const filterForm = document.querySelector('[data-kt-ruangan-history-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-ruangan-history-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-ruangan-history-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-ruangan-history-table-filter="form"]');
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
        const filterSearch = document.querySelector('[data-kt-ruangan-history-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    const handleurl = () => {
        let filterButton = document.querySelector('[data-kt-ruangan-detail-filter="filter"]');
        let selectOptions = document.querySelector('#selectruangan');
        filterButton.addEventListener('click', () => {
            if (selectOptions.value && selectOptions.value !== '') {
                location.assign(`/Company/ruangan/${selectOptions.value}`);
            }
        })
    }

    const handleEditRuangan = () => {
        let viewRuangan = document.querySelector('[data-unique="viewRuangan"]');
        let editRuangan = document.querySelector('[data-unique="editRuangan"]');
        let buttonEdit = document.querySelector('[data-unique="edit"]');
        let tempDiv = document.querySelector('[data-unique="tempDiv"]');
        let buttonCancel = document.querySelector('[data-unique="cancel"]');



        buttonEdit.addEventListener('click', () => {
            buttonEdit.classList.add('d-none');
            tempDiv.classList.remove('d-none');
            viewRuangan.classList.add('d-none');
            editRuangan.classList.remove('d-none');
        });

        buttonCancel.addEventListener('click', () => {
            buttonEdit.classList.remove('d-none');
            tempDiv.classList.add('d-none');;
            viewRuangan.classList.remove('d-none');
            editRuangan.classList.add('d-none');
        });        
    }

    const initEditRuangan = () => {
        const submitButton = document.querySelector('[data-unique="save"]');
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'editRuanganName': {
                        validators: {
                            notEmpty: {
                                message: 'Ruangan name is required'
                            }
                        }
                    },
                    'editRuanganKode': {
                        validators: {
                            notEmpty: {
                                message: 'Ruangan kode is required'
                            }
                        }
                    },
                    'editRuanganUnitkerja': {
                        validators: {
                            notEmpty: {
                                message: 'Ruangan Unitkerja is required'
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
            let editRuanganName = form.editRuanganName.value;
            let editRuanganKode = form.editRuanganKode.value;
            let editstatus = document.querySelector("input[type='radio'][name=editRuanganStatus]:checked").value;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        try {
                            fetch('/CompanyController/ruanganUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, editRuanganName, editRuanganKode, editstatus}),
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
                                            text: "Ruangan Berhasil Diubah!",
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
                                                location.assign(`/Company/ruangan/${id}`);
                                            }
                                        });
                                    }else{
                                        Swal.fire({
                                            text: "Sorry, Kode Ruangan Sudah Ada.!",
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
                                    // Show popup confirmation 

        
                                    //form.submit(); // Submit form
                                }, 2000);
                            })
                            .catch(error => {
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
            handleEditRuangan();
            initEditRuangan();
            initHistoryRuanganTable();
            handleSearchDatatable();
            handleHistoryFilterDatatable();
            handleResetForm();
        }
    };
}();

const handleLinkedRuangan = function() {
    const form = document.querySelector('#edit_ruangan_form');
    let id = form.id_ruangan.value;

    const initKaryawanLinkedRuanganTable= () => {
        let table = document.querySelector('#ruanganKaryawanTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/karyawanInRuangan/${id}` ,
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

    const initAsetLinkedRuanganTable= () => {
        let table = document.querySelector('#ruanganInventarisTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/asetInRuangan/${id}` ,
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
        const filterForm = document.querySelector('[data-kt-ruangan-linked-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-ruangan-linked-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll('select');
        const ruanganTable = document.querySelector('[data-unique="ruanganRuanganTable"]');
        const karyawanTable = document.querySelector('[data-unique="ruanganKaryawanTable"]');
        const inventarisTable = document.querySelector('[data-unique="ruanganInventarisTable"]');
        let title = document.querySelector('#linked-ruangan-title');
        let filterString = '';
        title.innerHTML = 'Karyawan Terhubung';
        karyawanTable.classList.remove('d-none');
        // initRuanganLinkedRuanganTable();
        initKaryawanLinkedRuanganTable();
        initAsetLinkedRuanganTable();
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

            if (filterString == '' ||filterString == 'Karyawan') {
                title.innerHTML = 'Karyawan Terhubung';
                // ruanganTable.classList.add('d-none');
                karyawanTable.classList.remove('d-none');
                inventarisTable.classList.add('d-none');
            }
            if (filterString == 'Inventaris') {
                title.innerHTML = 'Inventaris Terhubung';
                // ruanganTable.classList.add('d-none');
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
    handleDetailRuangan.init();
    handleLinkedRuangan.init();
});