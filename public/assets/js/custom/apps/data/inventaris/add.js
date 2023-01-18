"use strict";

const inventarisAdd = function () {
    // Shared variables
    const form = document.querySelector('#kt_add_inventaris_form');
    let table = $('#addInventarisTable');
    // Init add schedule modal
    const handleAddInventaris = () => {
        let copyButton = document.querySelectorAll('.notadinascopy');
        let productSelect = $('#inventaris_product');
        let createdBy = form.inventaris_createdby.value;
        const optionFormat = (item) => {
            if (!item.id) {
                return item.text;
            }
        
            var span = document.createElement('table');
            span.classList.add('table','table-sm', 'table-bordered', 'table-row-bordered', 'gx-7');
            var template = '';
        
            template += '<thead><tr class="fw-bold fs-6 text-muted">';
            template += '<th class="min-w-125px">Product</th><th class="min-w-125px">Brand</th><th class="min-w-125px">Satuan</th><th class="min-w-125px">Jenis</th></tr></thead>';
            template += '<tbody><tr><td>'+item.text+'</td><td>'+item.brand+'</td><td>'+item.satuan+'</td><td>'+item.jenis+'</td></tr></tbody>';    
            span.innerHTML = template;
        
            return $(span);
        }

        productSelect.select2({
            ajax : {
                url : '/UnitController/listProductSelect2/',
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
                $(data.element).attr('data-jenis', data.jenis);
                return data.text;
            },
            templateResult: optionFormat,
        }).on('change', function(e) {
            console.log($(this).select2('data')[0]);
        });

        copyButton.forEach(element => {
            element.addEventListener('click', (e) => {
                e.preventDefault();
                navigator.clipboard.writeText(e.target.innerHTML);
              
                /* Alert the copied text */
                alert("Copied the text: " + e.target.innerHTML);
            });
        });


        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'inventaris_product': {
                        validators: {
                            notEmpty: {
                                message: 'Product is required'
                            }
                        }
                    },
                    'inventaris_notadinas': {
                        validators: {
                            notEmpty: {
                                message: 'No Nota Dinas is required'
                            }
                        }
                    },
                    'inventaris_invoice': {
                        validators: {
                            notEmpty: {
                                message: 'No Invoice is required'
                            }
                        }
                    },
                    'inventaris_harga': {
                        validators: {
                            notEmpty: {
                                message: 'Harga is required'
                            }
                        }
                    },
                    'inventaris_jumlah': {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah is required'
                            }
                        }
                    },
                    'inventaris_kondisi': {
                        validators: {
                            notEmpty: {
                                message: 'Kondisi is required'
                            }
                        }
                    },
                    'inventaris_tahun': {
                        validators: {
                            notEmpty: {
                                message: 'Tahun is required'
                            }
                        }
                    },
                    'inventaris_supplier': {
                        validators: {
                            notEmpty: {
                                message: 'Supplier is required'
                            }
                        }
                    },
                    'inventaris_lokasi': {
                        validators: {
                            notEmpty: {
                                message: 'Lokasi is required'
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
        const addTable = document.querySelector('[data-kt-inventaris-add-action="addtable"]');
        addTable.addEventListener('click', e => {
            e.preventDefault();
            ;
            let jenisProduct = form.inventaris_product.options[form.inventaris_product.selectedIndex].dataset.jenis;
            let productName = form.inventaris_product.options[form.inventaris_product.selectedIndex].text;
            let productId = form.inventaris_product.options[form.inventaris_product.selectedIndex].value;
            let inventarisKondisi = form.inventaris_kondisi.value;
            let inventarisTahun = form.inventaris_tahun.value;
            let inventarisSupplierName = form.inventaris_supplier.options[form.inventaris_supplier.selectedIndex].text;
            let inventarisSupplierId = form.inventaris_supplier.options[form.inventaris_supplier.selectedIndex].value;
            let inventarisKaryawanName = form.inventaris_karyawan.options[form.inventaris_karyawan.selectedIndex].text;
            let inventarisKaryawanId = form.inventaris_karyawan.options[form.inventaris_karyawan.selectedIndex].value;
            let inventarisLokasiName = form.inventaris_lokasi.options[form.inventaris_lokasi.selectedIndex].text;
            let inventarisLokasiId = form.inventaris_lokasi.options[form.inventaris_lokasi.selectedIndex].value;
            let qtyInventaris = form.inventaris_jumlah.value;
            let notadinasInventaris = form.inventaris_notadinas.value;
            let invoiceInventaris = form.inventaris_invoice.value;
            let hargaInventaris = form.inventaris_harga.value;
            let subtotalHarga = hargaInventaris*qtyInventaris;
            let status_inventaris = form.inventaris_status.value ;

            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        try {
                            if (jenisProduct == 'Tidak Habis Pakai') {
                                for (let index = 1; index <= qtyInventaris; index++) {
                                    $('#addInventarisTable tbody:last-child').append(
                                        `<tr>
                                            '<td data-idProduct="${productId}" >${productName}</td>
                                            '<td data-notadinas="${notadinasInventaris}" data-invoice="${invoiceInventaris}">1</td>
                                            '<td>${inventarisKondisi}</td>
                                            '<td data-status="${status_inventaris}">${inventarisTahun}</td>
                                            '<td data-idSupplier="${inventarisSupplierId}" >${inventarisSupplierName}</td>
                                            '<td data-idKaryawan="${inventarisKaryawanId}">${inventarisKaryawanName}</td>
                                            '<td data-idLokasi="${inventarisLokasiId}">${inventarisLokasiName}</td>
                                            '<td>${hargaInventaris}</td>
                                            '<td>${subtotalHarga}</td>
                                        </tr>`
                                        )
                                }
                            } else {
                                $('#addInventarisTable tbody:last-child').append(
                                    `<tr>
                                        '<td data-idProduct="${productId}" >${productName}</td>
                                        '<td data-notadinas="${notadinasInventaris}" data-invoice="${invoiceInventaris}">${qtyInventaris}</td>
                                        '<td>${inventarisKondisi}</td>
                                        '<td data-status="${status_inventaris}">${inventarisTahun}</td>
                                        '<td data-idSupplier="${inventarisSupplierId}" >${inventarisSupplierName}</td>
                                        '<td data-idKaryawan="${inventarisKaryawanId}">${inventarisKaryawanName}</td>
                                        '<td data-idLokasi="${inventarisLokasiId}">${inventarisLokasiName}</td>
                                        '<td>${hargaInventaris}</td>
                                        '<td>${subtotalHarga}</td>
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


        const resetTable = document.querySelector('[data-kt-inventaris-reset-action="resetable"]');
        resetTable.addEventListener('click', e =>{
            e.preventDefault();
            setTimeout(function () {
                $('#addInventarisTable > tbody > tr').remove();
                Swal.fire({
                    text: "Table has been successfully reset!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                })

                //form.submit(); // Submit form
            }, 50);
        })

        const addDatabase = document.querySelector('[data-kt-inventaris-database-action="adddatabase"]');
        addDatabase.addEventListener('click', e =>{
            e.preventDefault();
            let data = [];

            $('#addInventarisTable tbody tr').each(function(row,tr){
                let tempData = {
                    'unit_id' : $(tr).find('td:eq(0)').attr('data-idProduct'), 
                    'supplier_id' : $(tr).find('td:eq(4)').attr('data-idSupplier'), 
                    'karyawan_id' : $(tr).find('td:eq(5)').attr('data-idKaryawan'), 
                    'unitkerja_id' : $(tr).find('td:eq(6)').attr('data-idLokasi'), 
                    'milik' : $(tr).find('td:eq(6)').attr('data-idLokasi'),
                    'status_unit' : $(tr).find('td:eq(3)').attr('data-status'), 
                    'kode_unit' : '0000', 
                    'foto_unit' : 0, 
                    'kondisi' : $(tr).find('td:eq(2)').text(), 
                    'tahun_perolehan' : $(tr).find('td:eq(3)').text(), 
                    'invoice' : $(tr).find('td:eq(1)').attr('data-invoice'), 
                    'nota_dinas' : $(tr).find('td:eq(1)').attr('data-notadinas'), 
                    'pj' : '0', 
                    'harga' : $(tr).find('td:eq(7)').text(), 
                    'stok' : $(tr).find('td:eq(1)').text(), 
                    'barcode' : '0', 
                    'created_by' : createdBy, 
                }
                data.push(tempData);
            })
            console.log(data);

            try {
                fetch('/UnitController/inventarisAdd',{
                    method : "POST",
                    body : JSON.stringify(data),
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                })
                .then((response) => response.json())
                .then((data) => {
                    setTimeout(function () {
                        // Remove loading indication
                        console.log(data);
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
                                // location.assign('/Data/Inventaris');
                            }
                        });
    
                        //form.submit(); // Submit form
                    }, 2000);
                });
                
            } catch (error) {
                console.log(error);
            }
        })
    }

    return {
        // Public functions
        init: function () {
            handleAddInventaris();
        }
    };

}();

KTUtil.onDOMContentLoaded(function () {
    inventarisAdd.init();
});