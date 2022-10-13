"use strict";

const handleDetailAccount = function() {
    const form = document.querySelector('#edit_account_form');
    let id = form.id_account.value;
    let table = document.querySelector('#accountHistoryTable');
    let datatable;
    let selectEditRoleAccount = $('[data-kt-account-table-filter="accountRole"]');
    
    const initHistoryAccountTable = () => {
        
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/UserController/accountHistoryList/${id}` ,
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
        const filterForm = document.querySelector('[data-kt-account-history-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-account-history-table-filter="filter"]');
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
        const resetButton = document.querySelector('[data-kt-account-history-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-account-history-table-filter="form"]');
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
        const filterSearch = document.querySelector('[data-kt-account-history-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    const handleurl = () => {
        let filterButton = document.querySelector('[data-kt-account-detail-filter="filter"]');
        let selectOptions = document.querySelector('#selectaccount');
        filterButton.addEventListener('click', () => {
            if (selectOptions.value && selectOptions.value !== '') {
                location.assign(`/User/account/${selectOptions.value}`);
            }
        })
    }

    const handleEditAccount = () => {
        let viewAccount = document.querySelector('[data-unique="viewAccount"]');
        let editAccount = document.querySelector('[data-unique="editAccount"]');
        let buttonEdit = document.querySelector('[data-unique="edit"]');
        let tempDiv = document.querySelector('[data-unique="tempDiv"]');
        let buttonCancel = document.querySelector('[data-unique="cancel"]');
        let roleAccount = form.user_role.value;
        let roleAccountText = document.querySelector('#roleAccountText').innerHTML;
        selectEditRoleAccount.val(roleAccount).trigger('change');
        
        // selectEditRoleAccount.empty().append(`<option value="${roleAccount}">${roleAccountText}</option>`).val(roleAccount).trigger('change');

        

        buttonEdit.addEventListener('click', () => {
            buttonEdit.classList.add('d-none');
            tempDiv.classList.remove('d-none');
            viewAccount.classList.add('d-none');
            editAccount.classList.remove('d-none');
        });

        buttonCancel.addEventListener('click', () => {
            buttonEdit.classList.remove('d-none');
            tempDiv.classList.add('d-none');;
            viewAccount.classList.remove('d-none');
            editAccount.classList.add('d-none');
        });        
    }

    const initEditAccount = () => {
        const submitButton = document.querySelector('[data-unique="save"]');
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'editAccountUsername': {
                        validators: {
                            notEmpty: {
                                message: 'Account Username is required'
                            }
                        }
                    },
                    'editAccountEmail': {
                        validators: {
                            notEmpty: {
                                message: 'Account Email is required'
                            }
                        }
                    },
                    'editAccountRole': {
                        validators: {
                            notEmpty: {
                                message: 'Account Role is required'
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
            let editAccountUsername = form.editAccountUsername.value;
            let editAccountEmail = form.editAccountEmail.value;
            let editAccountRole = selectEditRoleAccount.val();
            let editstatus = document.querySelector("input[type='radio'][name=editAccountStatus]:checked").value;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        console.log(editstatus);
                        console.log(id);
                        console.log(editAccountEmail);
                        console.log(editAccountRole);
                        console.log(editAccountUsername);
                        try {
                            fetch('/UserController/accountUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, editAccountEmail, editAccountUsername, editAccountRole, editstatus}),
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
                                            text: "Data Account Berhasil Diubah!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, Mengerti!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                // modal.hide();
                                                location.assign(`/User/account/${id}`);
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            text: "Sorry, Email atau Username Sudah Ada.!",
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
            handleEditAccount();
            initEditAccount();
            initHistoryAccountTable();
            handleSearchDatatable();
            handleHistoryFilterDatatable();
            handleResetForm();
        }
    };
}();

const handleLinkedAccount = function() {
    const form = document.querySelector('#edit_account_form');
    let id = form.id_account.value;
    
    console.log(moment("20120620", "YYYYMMDD").fromNow());


    const initLoginLinkedAccountTable= () => {
        let table = document.querySelector('#accountLoginTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/UserController/loginInAccount/${id}` ,
                "dataSrc" : "",
            },
            "pageLength": 10,
            "lengthChange": false,
            "columns": [
                {"data" : 'email'},
                {"data" : 'username'},
                {"data" : 'date'},
            ],
            'order': [[2, 'desc']],
            "columnDefs": [
                {
                    targets: 2,
                    orderable: false,
                    render: function (data, type, row) {
                        moment.locale();
                        return `${data}<span class="badge badge-light fw-bolder">${moment(data, "YYYYMMDD").fromNow()}</span>`;
                    },
                },
            ]
            
        });

        datatable.on('draw', function () {
           
        });
    }

    const initEventLinkedAccountTable= () => {
        let table = document.querySelector('#accountEventTable');
        let datatable;

        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/UserController/eventInAccount/${id}` ,
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

    const handleLinkedFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-account-linked-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-account-linked-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll('select');
        const loginTable = document.querySelector('[data-unique="accountLoginTable"]');
        const eventTable = document.querySelector('[data-unique="accountEventTable"]');
        let title = document.querySelector('#linked-account-title');
        let filterString = '';
        title.innerHTML = 'Login Log';
        initLoginLinkedAccountTable();
        initEventLinkedAccountTable();
        loginTable.classList.remove('d-none');
        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += ' ';
                    }

                    // Build filter value options
                    filterString = item.value;
                    console.log(filterString);
                }
            });

            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            // datatable.search(filterString).draw();
            if (filterString == '' || filterString == 'login') {
                title.innerHTML = 'Login Log';
                loginTable.classList.remove('d-none');
                eventTable.classList.add('d-none');
            }
            if (filterString == 'event') {
                title.innerHTML = 'Event Log';
                loginTable.classList.add('d-none');
                eventTable.classList.remove('d-none');
            }

        });
    }



    return {
        init: function () {
            handleLinkedFilterDatatable();
        }
    }
}();

const handleChangePasswordAccount = function() {
    const element = document.getElementById('kt_modal_update_password');
    const form = element.querySelector('#kt_modal_update_password_form');
    const modal = new bootstrap.Modal(element);
    const id = document.querySelector('#id_account').value;

    // Init add schedule modal
    const initChangePassword = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'new_password': {
                        validators: {
                            notEmpty: {
                                message: 'password is required'
                            }
                        }
                    },
                    'confirm_password': {
                        validators: {
                            notEmpty: {
                                message: 'The password confirmation is required'
                            },
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="new_password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
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
        const submitButton = element.querySelector('[data-kt-account-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();
            let password = form.new_password.value;
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                        console.log(password);
                        console.log(id);
                        try {
                            fetch('/UserController/passwordUpdate',{
                                method : "POST",
                                body : JSON.stringify({id, password}),
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
                                            text: "Password Account Berhasil Diubah!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, Mengerti!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                modal.hide();
                                                location.assign(`/User/account/${$id}`);
                                            }
                                        });
                                    } else {
                                        
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
        const cancelButton = element.querySelector('[data-kt-account-modal-action="cancel"]');
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
        const closeButton = element.querySelector('[data-kt-account-modal-action="close"]');
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
        init: function () {
            initChangePassword();
        }
    }
}();


KTUtil.onDOMContentLoaded(function () {
    handleDetailAccount.init();
    handleLinkedAccount.init();
    handleChangePasswordAccount.init();
});