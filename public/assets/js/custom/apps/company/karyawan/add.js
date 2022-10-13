"use strict";

const karyawanAdd = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_karyawan');
    const form = element.querySelector('#kt_modal_add_karyawan_form');
    const modal = new bootstrap.Modal(element);
    const selectRuangan = $('#karyawan_ruangan');
    const selectJabatan = $('#karyawan_jabatan');

    // Init add schedule modal
    const initAddkaryawan = () => {

        selectJabatan.select2({
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



        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'karyawan_jabatan': {
                        validators: {
                            notEmpty: {
                                message: 'karyawan jabatan is required'
                            }
                        }
                    },
                    'karyawan_name': {
                        validators: {
                            notEmpty: {
                                message: 'karyawan name is required'
                            }
                        }
                    },
                    'karyawan_nrp': {
                        validators: {
                            notEmpty: {
                                message: 'karyawan name is required'
                            }
                        }
                    },
                    'karyawan_alamat': {
                        validators: {
                            notEmpty: {
                                message: 'karyawan name is required'
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
        const submitButton = element.querySelector('[data-kt-karyawan-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let karyawan_name = form.karyawan_name.value;
            let karyawan_nrp = form.karyawan_nrp.value;
            let karyawan_alamat = form.karyawan_alamat.value;
            let karyawan_jabatan = selectJabatan.val();
            let karyawan_status = document.querySelector("input[type='radio'][name=karyawan_status]:checked").value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        try {
                            // console.log(JSON.stringify({karyawan_name}));
                            // console.log(JSON.stringify({karyawan_jabatan}));
                            // console.log(JSON.stringify({karyawan_alamat}));
                            // console.log(JSON.stringify({karyawan_nrp}));
                            fetch('/CompanyController/karyawanCreate',{
                                method : "POST",
                                body : JSON.stringify({karyawan_name, karyawan_nrp, karyawan_alamat, karyawan_jabatan,karyawan_status}),
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
                                    submitButton.disabled = false;
                                    if (data) {
                                        // Show popup confirmation 
                                        Swal.fire({
                                            text: "Data Karyawan Berhasil Disimpan!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, Mengerti!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                modal.hide();
                                                location.assign('/Company/karyawan');
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
        const cancelButton = element.querySelector('[data-kt-karyawan-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-karyawan-modal-action="close"]');
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
            initAddkaryawan();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    karyawanAdd.init();
});