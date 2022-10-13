"use strict";

const handleDetailKaryawan = function() {
    const form = document.querySelector('#edit_karyawan_form');
    let id = form.id_karyawan.value;
    let table = document.querySelector('#karyawanHistoryTable');
    let datatable;
    let selectEditJabatanKaryawan = $('[data-kt-karyawan-table-filter="jabatanKaryawan"]');
    
    const initHistoryKaryawanTable = () => {
        
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/karyawanHistoryList/${id}` ,
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
        const filterForm = document.querySelector('[data-kt-karyawan-history-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-karyawan-history-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-karyawan-history-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-karyawan-history-table-filter="form"]');
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
        const filterSearch = document.querySelector('[data-kt-karyawan-history-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    const handleurl = () => {
        let filterButton = document.querySelector('[data-kt-karyawan-detail-filter="filter"]');
        let selectOptions = document.querySelector('#selectkaryawan');
        filterButton.addEventListener('click', () => {
            if (selectOptions.value && selectOptions.value !== '') {
                location.assign(`/Company/karyawan/${selectOptions.value}`);
            }
        })
    }

    const handleEditKaryawan = () => {
        let viewKaryawan = document.querySelector('[data-unique="viewKaryawan"]');
        let editKaryawan = document.querySelector('[data-unique="editKaryawan"]');
        let buttonEdit = document.querySelector('[data-unique="edit"]');
        let tempDiv = document.querySelector('[data-unique="tempDiv"]');
        let buttonCancel = document.querySelector('[data-unique="cancel"]');
        let jabatanKaryawan = form.karyawan_jabatan.value;
        let jabatanKaryawanText = document.querySelector('#karyawanJabatanText').innerHTML;
        selectEditJabatanKaryawan.select2({
            ajax : {
                url : '/CompanyController/listJabatanSelect2/',
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
        selectEditJabatanKaryawan.empty().append(`<option value="${jabatanKaryawan}">${jabatanKaryawanText}</option>`).val(jabatanKaryawan).trigger('change');

        buttonEdit.addEventListener('click', () => {
            buttonEdit.classList.add('d-none');
            tempDiv.classList.remove('d-none');
            viewKaryawan.classList.add('d-none');
            editKaryawan.classList.remove('d-none');
        });

        buttonCancel.addEventListener('click', () => {
            buttonEdit.classList.remove('d-none');
            tempDiv.classList.add('d-none');;
            viewKaryawan.classList.remove('d-none');
            editKaryawan.classList.add('d-none');
        });        
    }

    const initEditKaryawan = () => {
        const submitButton = document.querySelector('[data-unique="save"]');
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'editKaryawanName': {
                        validators: {
                            notEmpty: {
                                message: 'Karyawan name is required'
                            }
                        }
                    },
                    'editKaryawanNrp': {
                        validators: {
                            notEmpty: {
                                message: 'Karyawan Nrp is required'
                            }
                        }
                    },
                    'editKaryawanJabatan': {
                        validators: {
                            notEmpty: {
                                message: 'Karyawan Jabatan is required'
                            }
                        }
                    },
                    'editKaryawanAlamat': {
                        validators: {
                            notEmpty: {
                                message: 'Karyawan Alamat is required'
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
            let editKaryawanName = form.editKaryawanName.value;
            let editKaryawanNrp = form.editKaryawanNrp.value;
            let editKaryawanJabatan = selectEditJabatanKaryawan.val();
            let editKaryawanAlamat = form.editKaryawanAlamat.value;
            let editstatus = document.querySelector("input[type='radio'][name=editKaryawanStatus]:checked").value;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        console.log(editstatus);
                        try {
                            fetch('/CompanyController/karyawanUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, editKaryawanName, editKaryawanNrp, editKaryawanJabatan, editKaryawanAlamat, editstatus}),
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-Requested-With": "XMLHttpRequest"
                                },
                            })
                            .then((response) => response.json())
                            .then((data) => {
                                setTimeout(function () {
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;
        
                                    if (data) {
                                        Swal.fire({
                                            text: "Data Karyawan Berhasil Diubah!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, Mengerti!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                // modal.hide();
                                                location.assign(`/Company/karyawan/${id}`);
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            text: "Sorry, NRP Sudah Ada.!",
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
                            })
                            
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
            handleEditKaryawan();
            initEditKaryawan();
            initHistoryKaryawanTable();
            handleSearchDatatable();
            handleHistoryFilterDatatable();
            handleResetForm();
        }
    };
}();

const handleLinkedKaryawan = function() {
    const form = document.querySelector('#edit_karyawan_form');
    let id = form.id_karyawan.value;
    

    const initUsersLinkedKaryawanTable= () => {
        let table = document.querySelector('#karyawanUserTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/usersInKaryawan/${id}` ,
                "dataSrc" : "",
            },
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'email'},
                {"data" : 'username'},
                {"data" : 'active'},
            ],
            "columnDefs": [
                {
                    targets: -1,
                    render: function (data, type, row) {
                        if (data == 1) {
                            return `Aktif`;
                        } else {
                            return `Tidak Aktif`;
                        }
                    },
                },
            ]
            
        });

        datatable.on('draw', function () {
           
        });
    }

    const initAsetLinkedKaryawanTable= () => {
        let table = document.querySelector('#karyawanInventarisTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/asetInKaryawan/${id}` ,
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
        const filterForm = document.querySelector('[data-kt-karyawan-linked-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-karyawan-linked-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll('select');
        const inventarisTable = document.querySelector('[data-unique="karyawanInventarisTable"]');
        const userTable = document.querySelector('[data-unique="karyawanUserTable"]');
        let title = document.querySelector('#linked-karyawan-title');
        let filterString = '';
        title.innerHTML = 'Inventaris Terhubung';
        initAsetLinkedKaryawanTable();
        initUsersLinkedKaryawanTable();
        inventarisTable.classList.remove('d-none');
        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += ' ';
                    }

                    // Build filter value options
                    filterString = item.value;
                }
            });
            if (filterString == '' || filterString == 'Inventaris') {
                title.innerHTML = 'Inventaris Terhubung';
                inventarisTable.classList.remove('d-none');
                userTable.classList.add('d-none');
            }
            if (filterString == 'User') {
                title.innerHTML = 'User Terhubung';
                inventarisTable.classList.add('d-none');
                userTable.classList.remove('d-none');
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
    handleDetailKaryawan.init();
    handleLinkedKaryawan.init();
});