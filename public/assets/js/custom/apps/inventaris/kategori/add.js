"use strict";

const kategoriAdd = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_kategori');
    const element1 = document.getElementById('kt_modal_add_subkategori');
    const form = element.querySelector('#kt_modal_add_kategori_form');
    const form1 = element1.querySelector('#kt_modal_add_subkategori_form');
    const modal = new bootstrap.Modal(element);
    const modal1 = new bootstrap.Modal(element1);

    const hasDuplicatedItems = function (inputArray) {
        const obj = {};
        const numItems = inputArray.length;
        const duplicateRemoved = [];
    
        for (const i in inputArray) {
            obj[inputArray[i]] = 0;
        }
    
        for (const i in obj) {
            duplicateRemoved.push(obj[i]);
        }
    
        return duplicateRemoved.length === numItems;
    };

    // Init add schedule modal
    const initAddkategori = () => {



        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'kategori_name': {
                        validators: {
                            notEmpty: {
                                message: 'kategori name is required'
                            }
                        }
                    },
                    'kategori_kode': {
                        validators: {
                            notEmpty: {
                                message: 'kategori kode is required'
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

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-kategori-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let kategori_name = form.kategori_name.value;
            let kategori_kode = form.kategori_kode.value;
            let kategori_deskripsi = form.kategori_deskripsi.value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        try {
                            console.log(JSON.stringify({kategori_name}));
                            fetch('/InventarisController/kategoriCreate',{
                                method : "POST",
                                body : JSON.stringify({kategori_deskripsi, kategori_name, kategori_kode}),
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
                                            text: "Data Kategori Berhasil Disimpan!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, Mengerti!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                modal.hide();
                                                location.assign('/Inventaris/kategori');
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            text: "Sorry, Kode Kategori Sudah Ada.!",
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

        
                                    //form.submit(); // Submit form
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
        const cancelButton = element.querySelector('[data-kt-kategori-modal-action="cancel"]');
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
                    form.reset(); // Reset form			
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
        const closeButton = element.querySelector('[data-kt-kategori-modal-action="close"]');
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
                    form.reset(); // Reset form			
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

    const initAddkategori1 = () => {


        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        let validator = FormValidation.formValidation(
            form1,
            {
                fields: {
                    'subkategori_kategori': {
                        validators: {
                            notEmpty: {
                                message: 'kategori is required'
                            }
                        }
                    },
                    'subkategori_jenis': {
                        validators: {
                            notEmpty: {
                                message: 'jenis sub kategori is required'
                            }
                        }
                    },
                    'subkategori_name': {
                        validators: {
                            notEmpty: {
                                message: 'sub kategori name is required'
                            }
                        }
                    },
                    'subkategori_kode': {
                        validators: {
                            notEmpty: {
                                message: 'sub kategori kode is required'
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

        // Submit button handler
        const submitButton = element1.querySelector('[data-kt-subkategori-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let kategori_name = form1.subkategori_name.value;
            let kategori_kode = form1.subkategori_kode.value;
            let kategori_deskripsi = form1.subkategori_deskripsi.value;
            let kategori_kategori = form1.subkategori_kategori.value;
            let kategori_jenis = form1.subkategori_jenis.value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        try {
                            console.log(JSON.stringify({kategori_kategori}));
                            fetch('/InventarisController/subkategoriCreate',{
                                method : "POST",
                                body : JSON.stringify({kategori_deskripsi, kategori_name, kategori_kode, kategori_kategori, kategori_jenis}),
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-Requested-With": "XMLHttpRequest"
                                },
                            });
                            setTimeout(function () {
                                // Remove loading indication
                                submitButton.removeAttribute('data-kt-indicator');
    
                                // Enable button
                                submitButton.disabled = false;
    
                                // Show popup confirmation 
                                Swal.fire({
                                    text: "Data Sub Kategori Berhasil Disimpan!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, Mengerti!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        modal1.hide();
                                        location.assign('/Inventaris/kategori');
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
        });

        // Cancel button handler
        const cancelButton = element1.querySelector('[data-kt-subkategori-modal-action="cancel"]');
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
                    form.reset(); // Reset form			
                    modal1.hide();	
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
        const closeButton = element1.querySelector('[data-kt-subkategori-modal-action="close"]');
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
                    form.reset(); // Reset form			
                    modal1.hide();	
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

    return {
        // Public functions
        init: function () {
            initAddkategori();
            initAddkategori1();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    kategoriAdd.init();
});