"use strict";

const handleDetailSubKategori = function() {
    const form = document.querySelector('#edit_subkategori_form');
    let id = form.id_subkategori.value;
    let table = document.querySelector('#subkategoriHistoryTable');
    let datatable;
    
    const initHistorySubKategoriTable = () => {
        
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/InventarisController/kategoriHistoryList/${id}` ,
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
        const filterForm = document.querySelector('[data-kt-subkategori-history-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-subkategori-history-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-subkategori-history-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-subkategori-history-table-filter="form"]');
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
        const filterSearch = document.querySelector('[data-kt-subkategori-history-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    const handleurl = () => {
        let filterButton = document.querySelector('[data-kt-subkategori-detail-filter="filter"]');
        let selectOptions = document.querySelector('#selectsubkategori');
        filterButton.addEventListener('click', () => {
            if (selectOptions.value && selectOptions.value !== '') {
                location.assign(`/Inventaris/subkategori/${selectOptions.value}`);
            }
        })
    }

    const handleEditSubKategori = () => {
        let viewSubKategori = document.querySelector('[data-unique="viewSubKategori"]');
        let editSubKategori = document.querySelector('[data-unique="editSubKategori"]');
        let buttonEdit = document.querySelector('[data-unique="edit"]');
        let tempDiv = document.querySelector('[data-unique="tempDiv"]');
        let buttonCancel = document.querySelector('[data-unique="cancel"]')

        buttonEdit.addEventListener('click', () => {
            buttonEdit.classList.add('d-none');
            tempDiv.classList.remove('d-none');
            viewSubKategori.classList.add('d-none');
            editSubKategori.classList.remove('d-none');
        });

        buttonCancel.addEventListener('click', () => {
            buttonEdit.classList.remove('d-none');
            tempDiv.classList.add('d-none');;
            viewSubKategori.classList.remove('d-none');
            editSubKategori.classList.add('d-none');
        });        
    }

    const initEditSubKategori = () => {
        const submitButton = document.querySelector('[data-unique="save"]');
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'editSubKategoriName': {
                        validators: {
                            notEmpty: {
                                message: 'SubKategori name is required'
                            }
                        }
                    },
                    'editSubKategoriKode': {
                        validators: {
                            notEmpty: {
                                message: 'SubKategori kode is required'
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
            let editSubKategoriName = form.editSubKategoriName.value;
            let editSubKategoriKode = form.editSubKategoriKode.value;
            let editSubKategoriDeskripsi = form.editSubKategoriDeskripsi.value;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        try {
                            fetch('/InventarisController/subkategoriUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, editSubKategoriName, editSubKategoriKode, editSubKategoriDeskripsi}),
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-Requested-With": "XMLHttpRequest"
                                },
                            })
                            .then(result => {
                                //Successful request processing
                                console.log(result);
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
                                    text: "Data Sub Kategori Berhasil Diubah!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, Mengerti!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        // modal.hide();
                                        location.assign(`/Inventaris/subkategori/${id}`);
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
            handleEditSubKategori();
            initEditSubKategori();
            initHistorySubKategoriTable();
            handleSearchDatatable();
            handleHistoryFilterDatatable();
            handleResetForm();
        }
    };
}();

const handleLinkedSubKategori = function() {
    const form = document.querySelector('#edit_subkategori_form');
    let id = form.id_subkategori.value;
    
    const initAsetLinkedSubKategoriTable= () => {
        let table = document.querySelector('#subkategoriInventarisTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/InventarisController/asetInsubKategori/${id}` ,
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

    return {
        init: function () {
            initAsetLinkedSubKategoriTable();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    handleDetailSubKategori.init();
    handleLinkedSubKategori.init();
});