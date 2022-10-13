"use strict";

const FormAdd = function () {
    // Shared variables
    const form = document.querySelector('#kt_add_pengajuanHabisPakai_form');
    const form1 = document.querySelector('#kt_add_pengajuanTidakHabisPakai_form');
    let inventarisSelect = $('#inventaris_unit');
    let inventarisSelect1 = $('#inventaris_unit1');
    let createdBy = form.inventaris_createdby.value;

    // Init add schedule modal
    const handleAddHabisPakai = () => {
        let currentStok = 0 ;
        const optionFormat = (item) => {
            if (!item.id) {
                return item.text;
            }
        
            var span = document.createElement('table');
            span.classList.add('table','table-sm', 'table-bordered', 'table-row-bordered', 'gx-7');
            var template = '';
        
            template += '<thead><tr class="fw-bold fs-6 text-muted">';
            template += '<th class="min-w-125px">Kode</th><th class="min-w-125px">Inventaris</th><th class="min-w-125px">Brand</th><th class="min-w-125px">Jenis</th></tr></thead>';
            template += '<tbody><tr><td>'+item.kode+'</td><td>'+item.text+'</td><td>'+item.brand+'</td><td>'+item.jenis+'</td></tr></tbody>';    
            span.innerHTML = template;
        
            return $(span);
        };

        $('#inventaris_jenisunit1').on('change', (e) => {
            e.preventDefault();
            if (e.target.value != '') {
                inventarisSelect1.val('').trigger('change');
                inventarisSelect1.select2({
                    ajax : {
                        url : `/OrderController/listInventarisHabisPakai`,
                        type: 'POST',
                        dataType : 'json',
                        data: function(params)
                        {
                            return {
                                searchTerm: params.term,
                                jenisProduk: e.target.value
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
                        $(data.element).attr('data-stok', data.stok);
                        $(data.element).attr('data-satuan', data.satuan);
                        return data.text;
                    },
                    templateResult: optionFormat,
                }).on('change', function(e) {
                    e.preventDefault();
                    console.log(e.target[e.target.selectedIndex]);
                    if (e.target.value == '') {
                        form.inventaris_stok.value = 0;
                        form.inventaris_satuan.value = 0;
                        currentStok = 0;
                    } else {
                        form.inventaris_stok.value = e.target[e.target.selectedIndex].dataset.stok;
                        currentStok = parseInt(e.target[e.target.selectedIndex].dataset.stok);
                        form.inventaris_satuan.value = e.target[e.target.selectedIndex].dataset.satuan;
                    }
                    
                });
            }else{
                inventarisSelect1.val('').trigger('change');
            }
        })

        
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'inventaris_unit1': {
                        validators: {
                            notEmpty: {
                                message: 'Inventaris is required'
                            }
                        }
                    },
                    'inventaris_deskripsi': {
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
        const addTable = document.querySelector('[data-kt-formhabispakai-add-action="addtable"]');
        addTable.addEventListener('click', e => {
            let inventarisProduct = form.inventaris_unit1.options[form.inventaris_unit1.selectedIndex];
            let inventarisLokasiTo = form.inventaris_lokasi.value;
            let inventarisLokasiToText = form.inventaris_lokasitext.value;
            let inventarisPeruntukan = form.inventaris_peruntukan.options[form.inventaris_peruntukan.selectedIndex];
            let inventarisStokdigunakan = form.inventaris_stokdigunakan.value;
            e.preventDefault();
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        var rowIdCnt = {};
            
                        // loop through check tds
                        $("#addInventarisPengajuanHabisPakaiTable tr td[col=id_unit]").each(function() {
                    
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
                            }else if(inventarisStokdigunakan > currentStok){
                                alert('Stok Tidak Valid atau melebihi stok yang ada');
                            }else{
                                $('#addInventarisPengajuanHabisPakaiTable tbody:last-child').append(
                                    `<tr>
                                        '<td>${inventarisProduct.dataset.kode}</td>
                                        '<td col="id_unit" data-idInventaris="${inventarisProduct.value}" >${inventarisProduct.text}</td>
                                        '<td>${parseInt(currentStok) - parseInt(inventarisStokdigunakan)}</td>
                                        '<td>${inventarisStokdigunakan}</td>
                                        '<td data-idLokasiInventaris="${inventarisLokasiTo}">${inventarisLokasiToText}</td>
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


        const resetTable = document.querySelector('[data-kt-formhabispakai-reset-action="resetable"]');
        resetTable.addEventListener('click', e =>{
            e.preventDefault();
            setTimeout(function () {
                $('#addInventarisPengajuanHabisPakaiTable > tbody > tr').remove();
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
                //form.submit(); // Submit form
            }, 50);
        })

        const addDatabase = document.querySelector('[data-kt-formhabispakai-database-action="adddatabase"]');
        addDatabase.addEventListener('click', e =>{
            e.preventDefault();
            let order = [];
            let dataorder = [];
            let inventarisLokasiTo = form.inventaris_lokasi.value;
            let inventarisDeskripsi = form.inventaris_deskripsi.value;
            let jenisInventaris = form.inventaris_jenisunit1.options[form.inventaris_jenisunit1.selectedIndex].value;
            let tempData1 = {
                'order_type' : 'Penggunaan', 
                'order_lokasi' : inventarisLokasiTo, 
                'deskripsi' : inventarisDeskripsi, 
                'status_order' : 'Belum di Approve', 
                'dokumen_order' : jenisInventaris, 
                'created_by' : createdBy, 
            }
            order.push(tempData1);
            $('#addInventarisPengajuanHabisPakaiTable tbody tr').each(function(row,tr){
                let tempData = {
                    'kode_order' : '', 
                    'detailunit_id' : $(tr).find('td:eq(1)').attr('data-idInventaris'), 
                    'qty' : $(tr).find('td:eq(3)').text(), 
                    'sisa' : $(tr).find('td:eq(2)').text(),
                    'peruntukan_awal' : 0,  
                    'peruntukan' : $(tr).find('td:eq(5)').attr('data-peruntukan'),  
                    'status_dataorder' : $(tr).find('td:eq(5)').attr('data-peruntukan') == '' ? 'Assign To Location' : 'Assign To Employee' , 
                }
                dataorder.push(tempData);
            })
            let data1 = {  'order' : order ,'dataorder' : dataorder}
            console.log(data1);
            try {
                fetch('/OrderController/addPemakaianHabisPakai',{
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
                            location.assign('/Data/Transaksi');
                        }
                    });

                    //form.submit(); // Submit form
                }, 2000);
            } catch (error) {
                console.log(error);
            }
        })
    }

    const handleAddTidakHabisPakai = () => {
        let currentStok = 0 ;
        let validator;
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
        };

        $('#inventaris_jenisunit').on('change', (e) => {
            e.preventDefault();
            if (e.target.value != '') {
                inventarisSelect.select2({
                    ajax : {
                        url : `/OrderController/listInventarisTidakHabisPakai`,
                        type: 'POST',
                        dataType : 'json',
                        data: function(params)
                        {
                            return {
                                searchTerm: params.term,
                                jenisProduk: e.target.value
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
                        $(data.element).attr('data-stok', data.stok);
                        $(data.element).attr('data-satuan', data.satuan);
                        $(data.element).attr('data-jenis', data.jenis);
                        return data.text;
                    },
                    templateResult: optionFormat,
                }).on('change', function(e) {
                    e.preventDefault();
                    if (e.target.value == '') {
                        form1.inventaris_stok1.value = 0;
                        form1.inventaris_satuan.value = 0;
                        currentStok = 0;
                    } else {
                        form1.inventaris_stok1.value = e.target[e.target.selectedIndex].dataset.stok;
                        currentStok = parseInt(e.target[e.target.selectedIndex].dataset.stok);
                        form1.inventaris_satuan.value = e.target[e.target.selectedIndex].dataset.satuan;
                    }
                    validator = FormValidation.formValidation(
                        form1,
                        {
                            fields: {
                                'inventaris_unit': {
                                    validators: {
                                        notEmpty: {
                                            message: 'Inventaris is required'
                                        }
                                    }
                                },
                                'inventaris_deskripsi': {
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
                });
            }
        })



       

        // Submit button handler
        const addTable = document.querySelector('[data-kt-formtidakhabispakai-add-action="addtable"]');
        addTable.addEventListener('click', e => {
            let inventarisProduct = form1.inventaris_unit.options[form1.inventaris_unit.selectedIndex];
            let inventarisLokasiTo = form.inventaris_lokasi.value;
            let inventarisLokasiToText = form.inventaris_lokasitext.value;
            let inventarisPeruntukan = form1.inventaris_peruntukan1.options[form1.inventaris_peruntukan1.selectedIndex];
            e.preventDefault();
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        var rowIdCnt = {};
                        // loop through check tds
                        $("#addInventarisPengajuanTidakHabisPakaiTable tr td[col=id_unit]").each(function() {
                    
                            // grab row identifer to check against other rows        
                            var rowId = $(this).attr("data-idInventaris");
                            var jenisId = $(this).attr("data-jenis");
                            if (rowId in rowIdCnt) {
                                rowIdCnt[rowId]++;
                            } else {
                                rowIdCnt[rowId] = 1;
                            }
                            
                    
                        });
                        console.log($("#addInventarisPengajuanTidakHabisPakaiTable tr:first td[col=id_unit]").attr('data-jenis'));
                        try {
                            if (rowIdCnt[inventarisProduct.value] > 0) {
                                alert('Barang Sudah Di input, Ingin Mengganti Kuantitas ?');
                            }else{
                                $('#addInventarisPengajuanTidakHabisPakaiTable tbody:last-child').append(
                                    `<tr>
                                        '<td>${inventarisProduct.dataset.kode}</td>
                                        '<td col="id_unit" data-jenis="${inventarisProduct.dataset.jenis}" data-idInventaris="${inventarisProduct.value}" >${inventarisProduct.text}</td>
                                        '<td data-idLokasiInventaris="${inventarisLokasiTo}">${inventarisLokasiToText}</td>
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


        const resetTable = document.querySelector('[data-kt-formtidakhabispakai-reset-action="resetable"]');
        resetTable.addEventListener('click', e =>{
            e.preventDefault();
            setTimeout(function () {
                $('#addInventarisPengajuanTidakHabisPakaiTable > tbody > tr').remove();
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
                //form.submit(); // Submit form
            }, 50);
        })

        const addDatabase = document.querySelector('[data-kt-formtidakhabispakai-database-action="adddatabase"]');
        addDatabase.addEventListener('click', e =>{
            e.preventDefault();
            let order = [];
            let dataorder = [];
            let inventarisLokasiTo = form.inventaris_lokasi.value;
            let inventarisDeskripsi = form1.inventaris_deskripsi.value;
            let tempData1 = {
                'order_type' : 'Penggunaan', 
                'order_lokasi' : inventarisLokasiTo, 
                'deskripsi' : inventarisDeskripsi, 
                'status_order' : 'Belum di Approve', 
                'dokumen_order' : $('#inventaris_jenisunit').val(), 
                'created_by' : createdBy, 
            }
            order.push(tempData1);
            $('#addInventarisPengajuanTidakHabisPakaiTable tbody tr').each(function(row,tr){
                let tempData = {
                    'kode_order' : '', 
                    'detailunit_id' : $(tr).find('td:eq(1)').attr('data-idInventaris'), 
                    'qty' : 1, 
                    'sisa' : 0,
                    'peruntukan_awal' : 0,  
                    'peruntukan' : $(tr).find('td:eq(3)').attr('data-peruntukan'),  
                    'status_dataorder' : $(tr).find('td:eq(3)').attr('data-peruntukan') == '' ? 'Assign To Location' : 'Assign To Employee' , 
                }
                dataorder.push(tempData);
            })
            let data1 = {  'order' : order ,'dataorder' : dataorder}
            console.log(data1);
            try {
                fetch('/OrderController/addPemakaianTidakHabisPakai',{
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
                            location.assign('/Data/Transaksi');
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
            handleAddHabisPakai();
            handleAddTidakHabisPakai();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    FormAdd.init();
});