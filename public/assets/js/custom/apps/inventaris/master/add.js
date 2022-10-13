"use strict";

const productAdd = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_product');
    const form = element.querySelector('#kt_modal_add_product_form');
    const modal = new bootstrap.Modal(element);
    // Init add schedule modal
    const initAddProduct = () => {



        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'product_name': {
                        validators: {
                            notEmpty: {
                                message: 'Product name is required'
                            }
                        }
                    },
                    'product_brand': {
                        validators: {
                            notEmpty: {
                                message: 'Product kode is required'
                            }
                        }
                    },
                    'product_satuan': {
                        validators: {
                            notEmpty: {
                                message: 'Product kode is required'
                            }
                        }
                    },
                    'product_subkategori': {
                        validators: {
                            notEmpty: {
                                message: 'Product kode is required'
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
        const submitButton = element.querySelector('[data-kt-product-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let product_name = form.product_name.value;
            let product_brand = form.product_brand.value;
            let product_satuan = form.product_satuan.value;
            let product_subkategori = form.product_subkategori.value;
            let product_jenis = document.querySelector("input[type='radio'][name=product_jenis]:checked").value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;

                        try {
                            fetch('/InventarisController/productCreate',{
                                method : "POST",
                                body : JSON.stringify({product_name, product_brand, product_satuan, product_subkategori, product_jenis}),
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
                                    text: "Data Product Berhasil Disimpan!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, Mengerti!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        modal.hide();
                                        location.assign('/Inventaris/product');
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
        const cancelButton = element.querySelector('[data-kt-product-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-product-modal-action="close"]');
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
            initAddProduct();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    productAdd.init();
});