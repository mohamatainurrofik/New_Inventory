"use strict";

const inventarisMutasi = function () {
    // Shared variables
    const form = document.querySelector('#kt_add_mutasiinventaris_form');
    let table = $('#addMutasiInventarisTable');
    let lokasiSelect = $('#mutasiinventaris_awal');
    let inventarisSelect = $('#mutasiinventaris_product');

    const handleLokasiInventaris = () => {
        let formNext = document.querySelector('[data-unique="afterSelectLokasi"]');
        lokasiSelect.on('change', function(e) {
            e.preventDefault();
            console.log(e.target.value);
            if (e.target.value == '') {
                formNext.classList.add('d-none');
            } else {
                formNext.classList.remove('d-none');
                initInventarisSelect(e.target.value);
            }
        });

        
    }

    const initInventarisSelect = (id) => {
        const optionFormat = (item) => {
            if (!item.id) {
                return item.text;
            }
        
            var span = document.createElement('table');
            span.classList.add('table','table-sm', 'table-bordered', 'table-row-bordered', 'gx-7');
            var template = '';
        
            template += '<thead><tr class="fw-bold fs-6 text-muted">';
            template += '<th class="min-w-125px">Kode</th><th class="min-w-125px">Inventaris</th><th class="min-w-125px">Brand</th></tr></thead>';
            template += '<tbody><tr><td>'+item.kode+'</td><td>'+item.text+'</td><td>'+item.brand+'</td></tr></tbody>';    
            span.innerHTML = template;
        
            return $(span);
        }


        inventarisSelect.select2({
            ajax : {
                url : `/UnitController/listInventaris/${id}`,
                type: 'POST',
                dataType : 'json',
                data: function(params)
                {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    console.log(data);
                        return {
                            results: data
                        };
                }
            },
            templateSelection: function (data, container) {
                $(data.element).attr('data-kode', data.kode);
                return data.text;
            },
            templateResult: optionFormat,
        })
    }
    // Init add schedule modal
    const handleMutasiInventaris = () => {
        let createdBy = form.mutasiinventaris_createdby.value;
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'mutasiinventaris_product': {
                        validators: {
                            notEmpty: {
                                message: 'Inventaris is required'
                            }
                        }
                    },
                    'mutasiinventaris_lokasi': {
                        validators: {
                            notEmpty: {
                                message: 'Lokasi is required'
                            }
                        }
                    },
                    'mutasiinventaris_status': {
                        validators: {
                            notEmpty: {
                                message: 'Status is required'
                            }
                        }
                    },
                    'mutasiinventaris_deskripsi': {
                        validators: {
                            notEmpty: {
                                message: 'Deskripsi is required'
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
        const addTable = document.querySelector('[data-kt-mutasiinventaris-add-action="addtable"]');
        addTable.addEventListener('click', e => {
            form.mutasiinventaris_lokasi.disabled = true;
            let inventarisProduct = form.mutasiinventaris_product.options[form.mutasiinventaris_product.selectedIndex];
            let inventarisLokasiTo = form.mutasiinventaris_lokasi.options[form.mutasiinventaris_lokasi.selectedIndex];
            let inventariStatus = form.mutasiinventaris_status.options[form.mutasiinventaris_status.selectedIndex];
            let inventarisPeruntukan = form.mutasiinventaris_karyawan.options[form.mutasiinventaris_karyawan.selectedIndex];
            let inventarisDeskripsi = form.mutasiinventaris_deskripsi.value;
            e.preventDefault();
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        var rowIdCnt = {};
            
                        // loop through check tds
                        $("#addMutasiInventarisTable tr td[col=id_unit]").each(function() {
                    
                            // grab row identifer to check against other rows        
                            var rowId = $(this).attr("data-idInventaris");
                            if (rowId in rowIdCnt) {
                                rowIdCnt[rowId]++;
                            } else {
                                rowIdCnt[rowId] = 1;
                            }
                    
                        });
                        try {
                            if (rowIdCnt[inventarisProduct.value] > 0) {
                                alert('Barang Sudah Di input, Ingin Mengganti Kuantitas ?');
                            }else{
                                $('#addMutasiInventarisTable tbody:last-child').append(
                                    `<tr>
                                        '<td>${inventarisProduct.dataset.kode}</td>
                                        '<td col="id_unit" data-idInventaris="${inventarisProduct.value}" >${inventarisProduct.text}</td>
                                        '<td data-idLokasiInventaris="${inventarisLokasiTo.value}">${inventarisLokasiTo.text}</td>
                                        '<td data-peruntukan="${inventarisPeruntukan.value}">${inventarisPeruntukan.text}</td>
                                    </tr>`
                                    )  
                            }
          
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


        const resetTable = document.querySelector('[data-kt-mutasiinventaris-reset-action="resetable"]');
        resetTable.addEventListener('click', e =>{
            e.preventDefault();
            setTimeout(function () {
                $('#addMutasiInventarisTable > tbody > tr').remove();
                form.reset();
                Swal.fire({
                    text: "Table has been successfully reset!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                })
                form.mutasiinventaris_lokasi.disabled = true;
                //form.submit(); // Submit form
            }, 50);
        })

        const addDatabase = document.querySelector('[data-kt-mutasiinventaris-database-action="adddatabase"]');
        addDatabase.addEventListener('click', e =>{
            e.preventDefault();
            let order = [];
            let dataorder = [];
            let tempData1 = {
                'order_type' : 'Mutasi', 
                'order_lokasi' : form.mutasiinventaris_lokasi.options[form.mutasiinventaris_lokasi.selectedIndex].value, 
                'deskripsi' : form.mutasiinventaris_deskripsi.value, 
                'status_order' : 'Berhasil', 
                'dokumen_order' : null, 
                'created_by' : createdBy, 
            }
            order.push(tempData1);
            $('#addMutasiInventarisTable tbody tr').each(function(row,tr){
                let tempData = {
                    'kode_order' : '', 
                    'detailunit_id' : $(tr).find('td:eq(1)').attr('data-idInventaris'), 
                    'qty' : 1, 
                    'sisa' : 1,
                    'peruntukan_awal' : 0,  
                    'peruntukan' : $(tr).find('td:eq(3)').attr('data-peruntukan'),  
                    'status_dataorder' : form.mutasiinventaris_status.options[form.mutasiinventaris_status.selectedIndex].value, 
                }
                dataorder.push(tempData);
            })
            let data1 = {  'order' : order ,'dataorder' : dataorder}
            console.log(order);
            console.log(dataorder);
            console.log(JSON.stringify(data1));
            try {
                fetch('/UnitController/inventarisMutasi',{
                    method : "POST",
                    body : JSON.stringify(data1),
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                });
                setTimeout(function () {
                    // Remove loading indication

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
                            location.assign('/Data/Inventaris');
                        }
                    });

                    //form.submit(); // Submit form
                }, 2000);
            } catch (error) {
                console.log(error);
            }
        })
    }

    return {
        // Public functions
        init: function () {
            handleLokasiInventaris();
            handleMutasiInventaris();
        }
    };

}();

KTUtil.onDOMContentLoaded(function () {
    inventarisMutasi.init();
});