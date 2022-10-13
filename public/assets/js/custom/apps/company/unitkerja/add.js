"use strict";

const unitkerjaAdd = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_unitkerja');
    const form = element.querySelector('#kt_modal_add_unitkerja_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    const initAddUnitkerja = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'unitkerja_name': {
                        validators: {
                            notEmpty: {
                                message: 'Unitkerja name is required'
                            }
                        }
                    },
                    'unitkerja_kode': {
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

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-unitkerja-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let unitkerja_name = form.unitkerja_name.value;
            let unitkerja_kode = form.unitkerja_kode.value;
            let unitkerja_status = document.querySelector("input[type='radio'][name=unitkerja_status]:checked").value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        try {
                            fetch('/CompanyController/unitkerjaCreate',{
                                method : "POST",
                                body : JSON.stringify({unitkerja_name, unitkerja_kode, unitkerja_status}),
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
                                                text: "Data Unitkerja Berhasil Disimpan!",
                                                icon: "success",
                                                buttonsStyling: false,
                                                confirmButtonText: "Ok, Mengerti!",
                                                customClass: {
                                                    confirmButton: "btn btn-primary"
                                                }
                                            }).then(function (result) {
                                                if (result.isConfirmed) {
                                                    modal.hide();
                                                    location.assign('/Company/unitkerja');
                                                }
                                            });
                                        } else {
                                            Swal.fire({
                                                text: "Sorry, Kode Unitkerja Sudah Ada.!",
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

                            }).
                            catch(function(error) {
                                console.log(error);
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
        const cancelButton = element.querySelector('[data-kt-unitkerja-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-unitkerja-modal-action="close"]');
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

    return {
        // Public functions
        init: function () {
            initAddUnitkerja();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    unitkerjaAdd.init();
});