"use strict";

const handleDetailInventaris = function() {
    const form = document.querySelector('#edit_detailInventaris_form');
    let id = form.id_inventaris.value;
    let table = document.querySelector('#inventarisHistoryTable');
    let datatable;
    
    const initHistoryInventarisTable = () => {
        
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/UnitController/inventarisHistoryList/${id}` ,
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
        const filterForm = document.querySelector('[data-kt-inventaris-history-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-inventaris-history-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-inventaris-history-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-inventaris-history-table-filter="form"]');
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
        const filterSearch = document.querySelector('[data-kt-inventaris-history-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    // const handleurl = () => {
    //     let filterButton = document.querySelector('[data-kt-inventaris-detail-filter="filter"]');
    //     let selectOptions = document.querySelector('#selectinventaris');
    //     filterButton.addEventListener('click', () => {
    //         if (selectOptions.value && selectOptions.value !== '') {
    //             location.assign(`/Company/inventaris/${selectOptions.value}`);
    //         }
    //     })
    // }

    const handleEditDetailInventaris = () => {
        let viewDetailInventaris = document.querySelector('[data-unique="viewDetailInventaris"]');
        let editDetailInventaris = document.querySelector('[data-unique="editDetailInventaris"]');
        let buttonEdit = document.querySelector('[data-unique="edit"]');
        let tempDiv = document.querySelector('[data-unique="tempDiv"]');
        let buttonCancel = document.querySelector('[data-unique="cancel"]');
        let supplierId = document.querySelector('#editSupplierId');
        let statusUnit = document.querySelector('#editStatus');
        let kondisiUnit = document.querySelector('#editKondisi');
        let lokasiUnit = document.querySelector('#editLokasi');
        let karyawanUnit = document.querySelector('#editKaryawan');

        $('#editInventarisSupplier').val(supplierId.value).trigger('change');
        $('#editInventarisStatus').val(statusUnit.value).trigger('change');
        $('#editInventarisKondisi').val(kondisiUnit.value).trigger('change');
        $('#editInventarisLokasi').val(lokasiUnit.value).trigger('change');
        $('#editInventarisPeruntukan').val(karyawanUnit.value).trigger('change');

        buttonEdit.addEventListener('click', () => {
            buttonEdit.classList.add('d-none');
            tempDiv.classList.remove('d-none');
            viewDetailInventaris.classList.add('d-none');
            editDetailInventaris.classList.remove('d-none');
        });

        buttonCancel.addEventListener('click', () => {
            buttonEdit.classList.remove('d-none');
            tempDiv.classList.add('d-none');;
            viewDetailInventaris.classList.remove('d-none');
            editDetailInventaris.classList.add('d-none');
        });        
    }

    const initEditInventaris = () => {
        const submitButton = document.querySelector('[data-unique="save"]');
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'editInventarisSupplier': {
                        validators: {
                            notEmpty: {
                                message: 'Supplier is required'
                            }
                        }
                    },
                    'editInventarisName': {
                        validators: {
                            notEmpty: {
                                message: 'Nama is required'
                            }
                        }
                    },
                    'editInventarisBrand': {
                        validators: {
                            notEmpty: {
                                message: 'Brand is required'
                            }
                        }
                    },
                    'editInventarisHarga': {
                        validators: {
                            notEmpty: {
                                message: 'Harga is required'
                            }
                        }
                    },
                    'editInventarisStatus': {
                        validators: {
                            notEmpty: {
                                message: 'Status is required'
                            }
                        }
                    },
                    'editInventarisKondisi': {
                        validators: {
                            notEmpty: {
                                message: 'Kondisi is required'
                            }
                        }
                    },
                    'editInventarisLokasi': {
                        validators: {
                            notEmpty: {
                                message: 'Lokasi is required'
                            }
                        }
                    },
                    'editInventarisPeruntukan': {
                        validators: {
                            notEmpty: {
                                message: 'Peruntukan is required'
                            }
                        }
                    },
                    'editInventarisTahun': {
                        validators: {
                            notEmpty: {
                                message: 'Tahun is required'
                            }
                        }
                    },
                    'editInventarisSatuan': {
                        validators: {
                            notEmpty: {
                                message: 'Satuan is required'
                            }
                        }
                    },
                    'editInventarisNotadinas': {
                        validators: {
                            notEmpty: {
                                message: 'Nota Dinas is required'
                            }
                        }
                    },
                    'editInventarisInvoice': {
                        validators: {
                            notEmpty: {
                                message: 'Invoice is required'
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
            let editInventarisSupplier = form.editInventarisSupplier.value;
            let editInventarisHarga = form.editInventarisHarga.value;
            let editInventarisStatus = form.editInventarisStatus.value;
            let editInventarisKondisi = form.editInventarisKondisi.value;
            let editInventarisLokasi = form.editInventarisLokasi.value;
            let editInventarisPeruntukan = form.editInventarisPeruntukan.value;
            let editInventarisTahun = form.editInventarisTahun.value;
            let editInventarisNotadinas = form.editInventarisNotadinas.value;
            let editInventarisInvoice = form.editInventarisInvoice.value;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        try {
                            fetch('/UnitController/inventarisUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, editInventarisSupplier, editInventarisHarga, editInventarisStatus, editInventarisKondisi,
                                                       editInventarisLokasi, editInventarisPeruntukan, editInventarisTahun, editInventarisNotadinas, editInventarisInvoice }),
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
                                    text: "Form has been successfully edited!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        // modal.hide();
                                        location.assign(`/Data/inventaris/${id}`);
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
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
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
            // handleurl();
            initEditInventaris();
            initHistoryInventarisTable();
            handleSearchDatatable();
            handleHistoryFilterDatatable();
            handleResetForm();
            handleEditDetailInventaris();
        }
    };
}();

// const handleLinkedUnitkerja = function() {
//     const form = document.querySelector('#edit_inventaris_form');
//     let id = form.id_inventaris.value;
    
//     const initRuanganLinkedUnitkerjaTable = () => {
//         let table = document.querySelector('#inventarisRuanganTable');
//         let datatable;
        
//         datatable = $(table).DataTable({
//             "ajax": {
//                 "url" :`${document.location.origin}/CompanyController/inventarisLinked/${id}` ,
//                 "dataSrc" : "",
//             },
//             'order': [],
//             "pageLength": 10,
//             "lengthChange": false,
//             "columns": [
//                 {"data" : 'kode_inventaris'},
//                 {"data" : 'inventaris'},
//                 {"data" : 'status_inventaris'},
//             ],
            
//         });

//         datatable.on('draw', function () {
           
//         });
//     }

//     const initKaryawanLinkedUnitkerjaTable= () => {
//         let table = document.querySelector('#inventarisKaryawanTable');
//         let datatable;

//         datatable = $(table).DataTable({
//             "ajax": {
//                 "url" :`${document.location.origin}/CompanyController/karyawanInUnitkerja/${id}` ,
//                 "dataSrc" : "",
//             },
//             'order': [],
//             "pageLength": 10,
//             "lengthChange": false,
//             "columns": [
//                 {"data" : 'nama'},
//                 {"data" : 'nrp'},
//                 {"data" : 'content'},
//                 {"data" : 'email'},
//                 {"data" : 'is_pic'},
//             ],
            
//         });

//         datatable.on('draw', function () {
           
//         });
//     }

//     const initAsetLinkedUnitkerjaTable= () => {
//         let table = document.querySelector('#inventarisInventarisTable');
//         let datatable;

//         datatable = $(table).DataTable({
//             "ajax": {
//                 "url" :`${document.location.origin}/CompanyController/asetInUnitkerja/${id}` ,
//                 "dataSrc" : "",
//             },
//             'order': [],
//             "pageLength": 10,
//             "lengthChange": false,
//             "columns": [
//                 {"data" : 'kode'},
//                 {"data" : 'content_product'},
//                 {"data" : 'nama_unit'},
//                 {"data" : 'brand'},
//                 {"data" : 'jenis_product'},
//                 {"data" : 'nama'},
//                 {"data" : 'status_unit'},
//             ],
            
//         });

//         datatable.on('draw', function () {
           
//         });
//     }

//     const handleLinkedFilterDatatable = () => {
//         // Select filter options
//         const filterForm = document.querySelector('[data-kt-inventaris-linked-table-filter="form"]');
//         const filterButton = filterForm.querySelector('[data-kt-inventaris-linked-table-filter="filter"]');
//         const selectOptions = filterForm.querySelectorAll('select');
//         const ruanganTable = document.querySelector('[data-unique="inventarisRuanganTable"]');
//         const karyawanTable = document.querySelector('[data-unique="inventarisKaryawanTable"]');
//         const inventarisTable = document.querySelector('[data-unique="inventarisInventarisTable"]');
//         let title = document.querySelector('#linked-inventaris-title');
//         let filterString = '';
//         title.innerHTML = 'Ruangan Terhubung';
//         ruanganTable.classList.remove('d-none');
//         initRuanganLinkedUnitkerjaTable();
//         initKaryawanLinkedUnitkerjaTable();
//         initAsetLinkedUnitkerjaTable();
//         // Filter datatable on submit
//         filterButton.addEventListener('click', function () {
//             selectOptions.forEach((item, index) => {
//                 if (item.value && item.value !== '') {
//                     if (index !== 0) {
//                         filterString += ' ';
//                     }

//                     // Build filter value options
//                     filterString = item.value;
//                     console.log(filterString);
//                 }
//             });

//             // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
//             // datatable.search(filterString).draw();
//             if (filterString == '' || filterString == 'Ruangan') {
//                 title.innerHTML = 'Ruangan Terhubung';
//                 ruanganTable.classList.remove('d-none');
//                 karyawanTable.classList.add('d-none');
//                 inventarisTable.classList.add('d-none');
//             }
//             if (filterString == 'Karyawan') {
//                 title.innerHTML = 'Karyawan Terhubung';
//                 ruanganTable.classList.add('d-none');
//                 karyawanTable.classList.remove('d-none');
//                 inventarisTable.classList.add('d-none');
//             }
//             if (filterString == 'Inventaris') {
//                 title.innerHTML = 'Inventaris Terhubung';
//                 ruanganTable.classList.add('d-none');
//                 karyawanTable.classList.add('d-none');
//                 inventarisTable.classList.remove('d-none');
//             }
//         });
//     }



//     return {
//         init: function () {
//             handleLinkedFilterDatatable();
//         }
//     }
// }();




KTUtil.onDOMContentLoaded(function () {
    handleDetailInventaris.init();

});