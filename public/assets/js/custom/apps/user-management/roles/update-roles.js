"use strict";

// Class definition
var KTUsersUpdatePermissions = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_update_role');
    const form = element.querySelector('#kt_modal_update_role_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    const initUpdatePermissions = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'role_name': {
                        validators: {
                            notEmpty: {
                                message: 'Role name is required'
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

        // Close button handler
        const closeButton = element.querySelector('[data-kt-roles-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to close?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, close it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    modal.hide(); // Hide modal				
                }
            });
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-roles-modal-action="cancel"]');
        cancelButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal				
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-roles-modal-action="submit"]');
        submitButton.addEventListener('click', function (e) {
            // Prevent default button action
            e.preventDefault();
            let values = [];
            let id= form.id_role.value;
            let editRoleName = form.role_name.value;
            let permissions = document.getElementsByName("permission[]");
            for(var i = 0; i < permissions.length; i++) {
                if (permissions[i].checked == true) {
                    values.push(permissions[i].value);
                }
            }
            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click 
                        submitButton.disabled = true;
                        console.log(values);
                        console.log(id);
                        console.log(editRoleName);
                        try {
                            fetch('/UserController/roleUpdate',{
                                method : "POST",
                                body : JSON.stringify({id,editRoleName,values}),
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-Requested-With": "XMLHttpRequest"
                                },
                            }).then(result => {
                                //Successful request processing
                                console.log(result);
                            }).
                              catch(function(error) {
                                console.log(error);
                              });
                        } catch (error) {
                            
                        }
                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function () {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButton.disabled = false;

                            // Show popup confirmation 
                            Swal.fire({
                                text: "Form has been successfully submitted!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    modal.hide();
                                    location.assign(`/User/roles`);
                                }
                            });

                            //form.submit(); // Submit form
                        }, 2000);
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

    // Select all handler
    const handleSelectAll = () => {
        // Define variables
        const selectAll = form.querySelector('#kt_roles_select_all');
        const allCheckboxes = form.querySelectorAll('[type="checkbox"]');

        // Handle check state
        selectAll.addEventListener('change', e => {

            // Apply check state to all checkboxes
            allCheckboxes.forEach(c => {
                c.checked = e.target.checked;
            });
        });
    }

    const handleRolePermissions = () => {
        const buttonClicked = document.querySelectorAll('.editRoles');
        const allCheckboxes = form.querySelectorAll('[type="checkbox"]');
        let id ;
        let roleNameEdit = form.role_name;
        let id_role = form.id_role;
        buttonClicked.forEach(c => {
            c.addEventListener('click', e => {
                form.reset();
                id = e.target.getAttribute('data-idRole');
                id_role.value = e.target.getAttribute('data-idRole');
                try {
                    fetch('/UserController/roleHasPermissions',{
                        method : "POST",
                        body : JSON.stringify({id}),
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                    }).then((response) => response.json())
                      .then((data) => {
                        console.log(data);
                        for (const i in data) {

                            $('#permissions'+data[i].permission_id+'').prop('checked',true);
                        }
                        form.role_name.value = data[0].name;
                      }).
                      catch(function(error) {
                        console.log(error);
                      });
                } catch (error) {
                    
                }
            });
        })

    }

    return {
        // Public functions
        init: function () {
            initUpdatePermissions();
            handleSelectAll();
            handleRolePermissions();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersUpdatePermissions.init();
});