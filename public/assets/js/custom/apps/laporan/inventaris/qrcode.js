"use strict";

const printQR = function () {
    const form = document.querySelector('#kt_printqrcode_form');
    const printQRCode = () => {
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'ruanganprint': {
                        validators: {
                            notEmpty: {
                                message: 'Ruangan is required'
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
        const submitButton = document.querySelector('[data-kt-printQRcode-action="printQRcode"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let ruangan = form.ruanganprint.value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        try {
                            location.assign(`/LaporanController/getDataPrint/${ruangan}`);
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
        });
    }


   
    return {
        // Public functions  
        init: () => {
            printQRCode();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    printQR.init();
});