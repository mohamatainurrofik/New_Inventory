"use strict";

const kriteriaAdd = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_kriteria');
    const form = element.querySelector('#kt_modal_add_kriteria_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    const initAddKriteria = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'kriteria_name': {
                        validators: {
                            notEmpty: {
                                message: 'Kriteria name is required'
                            }
                        }
                    },
                    'kriteria_kode': {
                        validators: {
                            notEmpty: {
                                message: 'Kriteria kode is required'
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
        const submitButton = element.querySelector('[data-kt-kriteria-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let kriteria_name = form.kriteria_name.value;
            let kriteria_kode = form.kriteria_kode.value;
            let kriteria_atribut = document.querySelector("input[type='radio'][name=kriteria_atribut]:checked").value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        try {
                            fetch('/AlgorithmController/kriteriaCreate',{
                                method : "POST",
                                body : JSON.stringify({kriteria_name, kriteria_kode, kriteria_atribut}),
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
                                            text: "Data Kriteria Berhasil Disimpan!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, Mengert!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                modal.hide();
                                                location.assign('/Fahp/kriteria');
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            text: "Sorry, Kode Krteria Sudah Ada.!",
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
                            confirmButtonText: "Ok, Mengert!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-kriteria-modal-action="cancel"]');
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
                        confirmButtonText: "Ok, Mengert!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-kriteria-modal-action="close"]');
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
                        confirmButtonText: "Ok, Mengert!",
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
            initAddKriteria();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    kriteriaAdd.init();
});