"use strict";

const jabatanAdd = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_jabatan');
    const form = element.querySelector('#kt_modal_add_jabatan_form');
    const modal = new bootstrap.Modal(element);
    const selectRuangan = $('#jabatan_ruangan');
    const selectDepartemen = $('#jabatan_departemen');

    // Init add schedule modal
    const initAddjabatan = () => {

        selectDepartemen.select2({
            ajax : {
                url : '/CompanyController/listDepartemenSelect2/',
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

        selectRuangan.select2({
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

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'jabatan_departemen': {
                        validators: {
                            notEmpty: {
                                message: 'jabatan departemen is required'
                            }
                        }
                    },
                    'jabatan_name': {
                        validators: {
                            notEmpty: {
                                message: 'jabatan name is required'
                            }
                        }
                    },
                    'jabatan_ruangan': {
                        validators: {
                            notEmpty: {
                                message: 'jabatan ruangan is required'
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
        const submitButton = element.querySelector('[data-kt-jabatan-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let jabatan_name = form.jabatan_name.value;
            let jabatan_ruangan = selectRuangan.val();
            let jabatan_departemen = selectDepartemen.val();
            let jabatan_status = document.querySelector("input[type='radio'][name=jabatan_status]:checked").value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        try {
                            console.log(JSON.stringify({jabatan_name}));
                            fetch('/CompanyController/jabatanCreate',{
                                method : "POST",
                                body : JSON.stringify({jabatan_ruangan, jabatan_departemen, jabatan_name, jabatan_status}),
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
                                    text: "Data Jabatan Berhasil Disimpan!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, Mengerti!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        modal.hide();
                                        location.assign('/Company/jabatan');
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
        const cancelButton = element.querySelector('[data-kt-jabatan-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-jabatan-modal-action="close"]');
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
            initAddjabatan();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    jabatanAdd.init();
});