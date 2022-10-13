"use strict";

const handleDetailSupplier = function() {
    const form = document.querySelector('#edit_supplier_form');
    let id = form.id_supplier.value;
    let table = document.querySelector('#supplierHistoryTable');
    let datatable;
    
    const initHistorySupplierTable = () => {
        
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/InventarisController/supplierHistoryList/${id}` ,
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
        const filterForm = document.querySelector('[data-kt-supplier-history-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-supplier-history-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-supplier-history-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-supplier-history-table-filter="form"]');
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
        const filterSearch = document.querySelector('[data-kt-supplier-history-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    const handleurl = () => {
        let filterButton = document.querySelector('[data-kt-supplier-detail-filter="filter"]');
        let selectOptions = document.querySelector('#selectsupplier');
        filterButton.addEventListener('click', () => {
            if (selectOptions.value && selectOptions.value !== '') {
                location.assign(`/Inventaris/supplier/${selectOptions.value}`);
            }
        })
    }

    const handleEditSupplier = () => {
        let viewSupplier = document.querySelector('[data-unique="viewSupplier"]');
        let editSupplier = document.querySelector('[data-unique="editSupplier"]');
        let buttonEdit = document.querySelector('[data-unique="edit"]');
        let tempDiv = document.querySelector('[data-unique="tempDiv"]');
        let buttonCancel = document.querySelector('[data-unique="cancel"]')

        buttonEdit.addEventListener('click', () => {
            buttonEdit.classList.add('d-none');
            tempDiv.classList.remove('d-none');
            viewSupplier.classList.add('d-none');
            editSupplier.classList.remove('d-none');
        });

        buttonCancel.addEventListener('click', () => {
            buttonEdit.classList.remove('d-none');
            tempDiv.classList.add('d-none');;
            viewSupplier.classList.remove('d-none');
            editSupplier.classList.add('d-none');
        });        
    }

    const initEditSupplier = () => {
        const submitButton = document.querySelector('[data-unique="save"]');
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'editSupplierName': {
                        validators: {
                            notEmpty: {
                                message: 'Supplier name is required'
                            }
                        }
                    },
                    'editSupplierEmail': {
                        validators: {
                            notEmpty: {
                                message: 'Supplier Email is required'
                            }
                        }
                    },
                    'editSupplierContact': {
                        validators: {
                            notEmpty: {
                                message: 'Supplier Contact is required'
                            }
                        }
                    },
                    'editSupplierAlamat': {
                        validators: {
                            notEmpty: {
                                message: 'Supplier Alamat is required'
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
            let editSupplierName = form.editSupplierName.value;
            let editSupplierEmail = form.editSupplierEmail.value;
            let editSupplierContact = form.editSupplierContact.value;
            let editSupplierAlamat = form.editSupplierAlamat.value;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        try {
                            fetch('/InventarisController/supplierUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, editSupplierName, editSupplierEmail, editSupplierContact, editSupplierAlamat}),
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
                                    text: "Data Supplier Berhasil Diubah!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, Mengerti!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        // modal.hide();
                                        location.assign(`/Inventaris/supplier/${id}`);
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
            handleEditSupplier();
            initEditSupplier();
            initHistorySupplierTable();
            handleSearchDatatable();
            handleHistoryFilterDatatable();
            handleResetForm();
        }
    };
}();

const handleLinkedSupplier = function() {
    const form = document.querySelector('#edit_supplier_form');
    let id = form.id_supplier.value;
    

    const initAsetLinkedSupplierTable= () => {
        let table = document.querySelector('#supplierInventarisTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/InventarisController/asetInSupplier/${id}` ,
                "dataSrc" : "",
            },
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'kode'},
                {"data" : 'content_supplier'},
                {"data" : 'nama_unit'},
                {"data" : 'brand'},
                {"data" : 'jenis_supplier'},
                {"data" : 'nama'},
                {"data" : 'status_unit'},
            ],
            
        });

        datatable.on('draw', function () {
           
        });
    }

    



    return {
        init: function () {
            initAsetLinkedSupplierTable();
        }
    }
}();




KTUtil.onDOMContentLoaded(function () {
    handleDetailSupplier.init();
    // handleLinkedSupplier.init();
});