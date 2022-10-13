"use strict";

const handleDetailJabatan = function() {
    const form = document.querySelector('#edit_jabatan_form');
    let id = form.id_jabatan.value;
    let table = document.querySelector('#jabatanHistoryTable');
    let datatable;
    const initHistoryJabatanTable = () => {
        
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
        const filterForm = document.querySelector('[data-kt-jabatan-history-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-jabatan-history-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-jabatan-history-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-jabatan-history-table-filter="form"]');
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
        const filterSearch = document.querySelector('[data-kt-jabatan-history-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    const handleurl = () => {
        let filterButton = document.querySelector('[data-kt-jabatan-detail-filter="filter"]');
        let selectOptions = document.querySelector('#selectjabatan');
        filterButton.addEventListener('click', () => {
            if (selectOptions.value && selectOptions.value !== '') {
                location.assign(`/Company/jabatan/${selectOptions.value}`);
            }
        })
    }

    const handleEditJabatan = () => {
        let viewJabatan = document.querySelector('[data-unique="viewJabatan"]');
        let editJabatan = document.querySelector('[data-unique="editJabatan"]');
        let buttonEdit = document.querySelector('[data-unique="edit"]');
        let tempDiv = document.querySelector('[data-unique="tempDiv"]');
        let buttonCancel = document.querySelector('[data-unique="cancel"]');



        buttonEdit.addEventListener('click', () => {
            buttonEdit.classList.add('d-none');
            tempDiv.classList.remove('d-none');
            viewJabatan.classList.add('d-none');
            editJabatan.classList.remove('d-none');
        });

        buttonCancel.addEventListener('click', () => {
            buttonEdit.classList.remove('d-none');
            tempDiv.classList.add('d-none');;
            viewJabatan.classList.remove('d-none');
            editJabatan.classList.add('d-none');
        });        
    }

    const initEditJabatan = () => {
        const submitButton = document.querySelector('[data-unique="save"]');
        let selectEditJabatanLokasi = $('[data-kt-jabatan-table-filter="lokasiJabatan"]');
        let jabatanLokasi = form.jabatan_lokasi.value;
        let jabatanLokasiText = document.querySelector('#jabatanUnitkerjaText').innerHTML;

        selectEditJabatanLokasi.select2({
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
        selectEditJabatanLokasi.empty().append(`<option value="${jabatanLokasi}">${jabatanLokasiText}</option>`).val(jabatanLokasi).trigger('change');
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'editJabatanName': {
                        validators: {
                            notEmpty: {
                                message: 'Jabatan name is required'
                            }
                        }
                    },
                    'editJabatanLokasi': {
                        validators: {
                            notEmpty: {
                                message: 'Jabatan Lokasi is required'
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
            let editJabatanName = form.editJabatanName.value;
            let editJabatanLokasi = selectEditJabatanLokasi.val();
            let editstatus = document.querySelector("input[type='radio'][name=editJabatanStatus]:checked").value;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        try {
                            fetch('/CompanyController/jabatanUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, editJabatanName, editJabatanLokasi, editstatus}),
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
                                    text: "Data Jabatan Berhasil Diubah!",
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
                                        location.assign(`/Company/jabatan/${id}`);
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
            handleEditJabatan();
            initEditJabatan();
            initHistoryJabatanTable();
            handleSearchDatatable();
            handleHistoryFilterDatatable();
            handleResetForm();
        }
    };
}();

const handleLinkedJabatan = function() {
    const form = document.querySelector('#edit_jabatan_form');
    let id = form.id_jabatan.value;
    


    const initKaryawanLinkedJabatanTable= () => {
        let table = document.querySelector('#jabatanKaryawanTable');
        let datatable;
        let title = document.querySelector('#linked-jabatan-title');

        title= 'Karyawan Terhubung';

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/CompanyController/karyawanInJabatan/${id}` ,
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






    return {
        init: function () {
            initKaryawanLinkedJabatanTable();
        }
    }
}();




KTUtil.onDOMContentLoaded(function () {
    handleDetailJabatan.init();
    handleLinkedJabatan.init();
});