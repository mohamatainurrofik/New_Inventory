"use strict";

"use strict";

const hitungFormMaintanance = function () {
    // Shared variables
    const form = document.querySelector('#kt_add_maintanance_form');
    let selectRuangan = $('#ruangan_maintananceInventaris');
    let selectUnit = $('#inventaris_maintananceunit');
    var fixData = [];
    const handleFormFuzzy = () => {
        selectRuangan.on('change', (e) => {
            e.preventDefault();
            if (e.target.value != '') {
                selectUnit.removeAttr('disabled');
                try {
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
            
            
                    selectUnit.select2({
                        ajax : {
                            url : `/UnitController/listInventaris/${e.target.value}`,
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
                } catch (error) {
                    
                }
            } else {
                selectUnit.prop('disabled', 'disabled');
            }
        })
    }

    const initAlternatifTotable = () => {
        let validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'inventaris_maintananceunit': {
                        validators: {
                            notEmpty: {
                                message: 'Inventaris is required'
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


        const addTable = document.querySelector('[data-kt-addmaintanance-table-action="addtotable"]');
        const selectOptions = form.querySelectorAll('.kriteriaForAlternatif');
        addTable.addEventListener('click', e => {
            // form.mutasiinventaris_lokasi.disabled = true;
            let inventarisMaintanance = form.inventaris_maintananceunit.options[form.inventaris_maintananceunit.selectedIndex];
            let valueKriteria = [];
            let td ;
            let td1 ;
            selectOptions.forEach((item,index) => {
                if (item.value && item.value !== '') {

                    // Build filter value options
                    valueKriteria.push(item.value);
                    td += `<td data-alternatif="${inventarisMaintanance.value}" data-alternatifkode="${inventarisMaintanance.dataset.kode}" data-alternatifname="${inventarisMaintanance.text}" data-kriteria="${item.id}" >${item.value}</td>`;
                    td1 += `<td data-row="${index}" data-alternatif="${inventarisMaintanance.value}" data-kriteria="${item.id}">0</td>`;
                }
            })
            
            // let inventarisLokasiTo = form.mutasiinventaris_lokasi.options[form.mutasiinventaris_lokasi.selectedIndex];
            // let inventariStatus = form.mutasiinventaris_status.options[form.mutasiinventaris_status.selectedIndex];
            // let inventarisPeruntukan = form.mutasiinventaris_karyawan.options[form.mutasiinventaris_karyawan.selectedIndex];
            // let inventarisDeskripsi = form.mutasiinventaris_deskripsi.value;
            e.preventDefault();
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');
                    if (status == 'Valid') {
                        var rowIdCnt = {};
            
                        // loop through check tds
                        $("#alternatifTable tr td[col=id_unit]").each(function() {
                    
                            // grab row identifer to check against other rows        
                            var rowId = $(this).attr("data-idInventaris");
                            if (rowId in rowIdCnt) {
                                rowIdCnt[rowId]++;
                            } else {
                                rowIdCnt[rowId] = 1;
                            }
                    
                        });
                        try {
                            if (rowIdCnt[inventarisMaintanance.value] > 0) {
                                Swal.fire({
                                    text: "Barang Sudah Di input, Ingin Mengganti Kuantitas ?",
                                    icon: "warning",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, Mengerti!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }else{
                                $('#alternatifTable tbody:last-child').append(
                                    `<tr>
                                        <td col="id_unit" data-idInventaris="${inventarisMaintanance.value}" >[${inventarisMaintanance.dataset.kode}] ${inventarisMaintanance.text}</td>
                                        ${td}
                                    </tr>`
                                )  
                                $('#NormalisasiAlternatifTable tbody:last-child').append(
                                    `<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <td col="id_unit" data-idInventaris="${inventarisMaintanance.value}" >[${inventarisMaintanance.dataset.kode}] ${inventarisMaintanance.text}</td>
                                        ${td1}
                                    </tr>`
                                )  
                                $('#NormalisasTerbobotAlternatifTable tbody:last-child').append(
                                    `<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <td col="id_unit" data-idInventaris="${inventarisMaintanance.value}" >[${inventarisMaintanance.dataset.kode}] ${inventarisMaintanance.text}</td>
                                        ${td1}
                                    </tr>`
                                )  
                                $('#SolusiNegatifTable tbody:last-child').append(
                                    `<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <td col="id_unit" data-idInventaris="${inventarisMaintanance.value}" >[${inventarisMaintanance.dataset.kode}] ${inventarisMaintanance.text}</td>
                                        ${td1}
                                    </tr>`
                                )  
                                $('#SolusiPositifTable tbody:last-child').append(
                                    `<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <td col="id_unit" data-idInventaris="${inventarisMaintanance.value}" >${inventarisMaintanance.text}[${inventarisMaintanance.dataset.kode}]</td>
                                        ${td1}
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
    }

    const handleMatrixFuzzyAHP = () => {
        let table = document.querySelector('pairwiseFuzzyTable');
            $('#pairwiseFuzzyTable tbody tr td.jumlah').each(function(){
                let that = $(this);
                let sum = 0;
                let count = 0;
                $('#pairwiseFuzzyTable').find('td[data-rowkriteria="'+that.data('jumlah')+'"][data-fuzzy="'+that.data('fuzzysum')+'"]').each(function() {
                    sum += parseFloat($(this).html());
                    count++;
                });
                that.html(sum);
                $('#fuzzySintesisTable').find('td[data-fuzzysumsintesis="'+that.data('fuzzysum')+'"][data-jumlahsintesis="'+that.data('jumlah')+'"]').html(sum);
            })

            $('#pairwiseFuzzyTable tbody tr td.summary').each(function(){
                let that = $(this);
                let sum = 0;
                let count = 0;
                $('#pairwiseFuzzyTable').find('td[class="jumlah"][data-fuzzysum="'+that.data('summary')+'"]').each(function() {
                    sum += parseFloat($(this).html());
                    count++;
                });
                that.html(sum);
            })

            $('#fuzzySintesisTable tbody tr td.tempJumlah').each(function(){
                let that = $(this);
                let sum = 0;
                let count = 0;
                // console.log(that.html());
                $('#pairwiseFuzzyTable').find('td[class="summary"][data-summary="'+that.data('invers')+'"]').each(function() {
                    sum = parseFloat(that.html())/parseFloat($(this).html());
                    count++;
                });
                $('#fuzzySintesisTable').find('td[data-sintesis="'+that.data('fuzzysumsintesis')+'"][data-sintesisfrom="'+that.data('jumlahsintesis')+'"]').html(sum.toFixed(4));
            })



    }

    const handleVektorTable = () => {
        let allTable = document.querySelectorAll('.vektorTable');

        allTable.forEach(c => {
            let idTable = c.id;
            let trueWeight = document.querySelector('#weight'+idTable+'');
            let min = [];
            $('#'+idTable+' tbody tr td:not(:first-child)').each(function(){
                let that = $(this);
                let sum = 0;
                let sumForB = 0;
                let sumForC = 0;
                let sumForD = 0;
                let sumForE= 0;
                $('#fuzzySintesisTable tbody tr').find('td[class="sintesisValue"][data-sintesis="'+that.data('fromsintesis')+'"]').each(function() {
                    let l = $(this).html();
                    let m =  $('#fuzzySintesisTable tbody tr').find('td[class="sintesisValue"][data-sintesis="m"][data-sintesisFrom="'+$(this).data('sintesisfrom')+'"]').html();
                    let mC =  $('#fuzzySintesisTable tbody tr').find('td[class="sintesisValue"][data-sintesis="m"][data-sintesisFrom="'+that.data('uposition')+'"]').html();
                    let u = $('#fuzzySintesisTable tbody tr').find('td[class="sintesisValue"][data-sintesis="u"][data-sintesisFrom="'+that.data('uposition')+'"]').html();
                    sum = parseFloat(l) - parseFloat(u);
                    sumForB = parseFloat(mC) - parseFloat(u);
                    sumForC = parseFloat(m) - parseFloat(l);
                    sumForD = sumForB - sumForC;
                    sumForE = sum / sumForD;
                    $('#'+idTable+' tbody tr').find('td[data-fromsintesis="l"][data-position="'+$(this).data('sintesisfrom')+'"]').html(sum.toFixed(4));
                    $('#'+idTable+' tbody tr').find('td[class="b"]').html(sumForB.toFixed(4));
                    $('#'+idTable+' tbody tr').find('td[class="c"][data-cposition="'+$(this).data('sintesisfrom')+'"]').html(sumForC.toFixed(4));
                    $('#'+idTable+' tbody tr').find('td[class="d"][data-dposition="'+$(this).data('sintesisfrom')+'"]').html(sumForD.toFixed(4));
                    $('#'+idTable+' tbody tr').find('td[class="e"][data-eposition="'+$(this).data('sintesisfrom')+'"]').html(sumForE.toFixed(4));
                    if (sumForE >= 1) {
                        $('#'+idTable+' tbody tr').find('td[class="f"][data-fposition="'+$(this).data('sintesisfrom')+'"]').html(1);
                    }else if(sumForE < 0){
                        $('#'+idTable+' tbody tr').find('td[class="f"][data-fposition="'+$(this).data('sintesisfrom')+'"]').html(0);
                    } else {
                        $('#'+idTable+' tbody tr').find('td[class="f"][data-fposition="'+$(this).data('sintesisfrom')+'"]').html(sumForE.toFixed(4));
                    }
                });
                that.parent().find('td[class="f"][data-fposition="'+that.data('position')+'"]').each(function(){
                    min.push(parseFloat($(this).html()));
                })
                let value = min.reduce((a, b) => Math.min(a, b));
                trueWeight.innerHTML =  value;
                $('#normalisasiBobotTable tbody tr').find('td[data-weightkriteria="'+that.data('uposition')+'"]').html(value);
            })

        })

        $('#normalisasiBobotTable').find('td.bobotjumlah').each(function() {
            let that = $(this);
            let sum = 0;
            let count = 0;
            $('#normalisasiBobotTable tbody tr td.bobotjumlah').each(function(){
                sum += parseFloat($(this).html());
                count++;
            });
            let weight = parseFloat($(this).html())/sum;
            $('#normalisasiBobotTable tbody tr').find('td.bobotnormalisasi[data-kriterianorm="'+that.data('weightkriteria')+'"]').html(weight.toFixed(4));
        })

    } 

    const hitung = () => {
        const hitungButton = document.querySelector('[data-kt-addmaintanance-hitung-action="hitung"]');
        const hitungDiv = document.querySelector('#hitungDiv');
        const addTable = document.querySelector('[data-kt-addmaintanance-table-action="addtotable"]');
        const buttonAfter = document.querySelector('[data-kt-maintanance-table-toolbar="afterhitung"]');
        function hitungNormalisasiALternatif()
        {
            let dataNorm = [];
            let i =0;
            $('#alternatifTable tbody tr td:not(:first-child)').each(function(){
                let that = $(this);
                let sum= 0;
                $('#alternatifTable tbody tr td[data-kriteria="'+that.data('kriteria')+'"]').each(function(){
                    let thoose = $(this);
                    sum = sum +  (parseFloat(thoose.html())**2);
                })
                console.log(sum);
                let normValue = parseFloat(that.html())/(Math.sqrt(sum));
                dataNorm.push(normValue);
            })
            $('#NormalisasiAlternatifTable tbody tr td:not(:first-child)').each(function(){
                $(this).html(dataNorm[i].toFixed(4));
                i++;
            })
        }

        function hitungNormalisasiTerbobot()
        {
            let datanormTerbobot = [];
            let i =0;
            $('#normalisasiBobotTable tbody tr').find('td.bobotnormalisasi').each(function(){
                let that = $(this);
                let bobotNormalisasi = that.html()
                let normalisasiTerbobot = 0;
                $('#NormalisasiAlternatifTable tbody tr td[data-kriteria="'+that.data('kriterianorm1')+'"]').each(function(){
                    normalisasiTerbobot = parseFloat(bobotNormalisasi) * parseFloat($(this).html());
                    // console.log(` ${parseFloat(bobotNormalisasi)} * ${parseFloat($(this).html())}`);
                    datanormTerbobot.push(normalisasiTerbobot);
                    $('#NormalisasTerbobotAlternatifTable tbody tr').find('td[data-kriteria="'+$(this).data('kriteria')+'"][data-alternatif="'+$(this).data('alternatif')+'"]').html(normalisasiTerbobot.toFixed(4)); 
                });
            })
            

        }

        function getSolusiIdeal()
        {
            let posifit = [];
            let negatif = [];
            let k =0;
            let j =0;
            $('#SolusiIdealTable tbody tr td:not(:first-child)').each(function(){
                let that = $(this);
                let min ;
                let max ;
                let data= [];
                $('#NormalisasTerbobotAlternatifTable tbody tr td[data-kriteria="'+that.data('solusikriteria')+'"]').each(function(){
                    data.push(parseFloat($(this).html()));
                })
                max = data.reduce((a, b) => Math.max(a, b));
                min = data.reduce((a, b) => Math.min(a, b));
                if (that.data('solusi') == 'positif') {
                    if (that.data('attributekriteria') == 'Cost') {
                        that.html(min);
                        
                    } else {
                        that.html(max);       
                    }
                } else {
                    if (that.data('attributekriteria') == 'Cost') {
                        that.html(max);            
                    } else {
                        that.html(min);       
                    }
                }
            })
            
            $('#SolusiIdealTable tbody tr td:not(:first-child)').each(function(){
                let that = $(this);
                $('#NormalisasTerbobotAlternatifTable tbody tr td[data-kriteria="'+that.data('solusikriteria')+'"]').each(function(){
                    if (that.data('solusi') == 'positif') {
                        let value = (parseFloat($(this).html())-parseFloat(that.html()))**2;
                        
                        posifit.push(value.toFixed(4));
                    } else {
                        let value1 = (parseFloat($(this).html())-parseFloat(that.html()))**2;
                       
                        negatif.push(value1.toFixed(4));
                    }
                })
            })


            $('#SolusiIdealTable tbody tr td:not(:first-child)').each(function(){
                let that = $(this);
                $('#SolusiPositifTable tbody tr td[data-kriteria="'+that.data('solusikriteria')+'"]').each(function(){
                    $(this).html(posifit[k]);
                    k++;
                })
                $('#SolusiNegatifTable tbody tr td[data-kriteria="'+that.data('solusikriteria')+'"]').each(function(){
                    $(this).html(negatif[j]);
                    j++;
                })
            })
            

            
        }

        function getRanking()
        {
            let preventif = [];
            $('#alternatifTable tbody tr td:not(:first-child)').each(function(){
                let that = $(this);
                let sum = 0;
                let sum1 = 0;
                $('#SolusiPositifTable tbody tr td[data-alternatif="'+that.data('alternatif')+'"]').each(function(){
                    sum += parseFloat($(this).html());
                })
                $('#SolusiNegatifTable tbody tr td[data-alternatif="'+that.data('alternatif')+'"]').each(function(){
                    sum1 += parseFloat($(this).html());
                })
                let d = Math.sqrt(sum1)/((Math.sqrt(sum1))+(Math.sqrt(sum)));
                let tempData = {
                    'id_alternatif' : that.data('alternatif'),
                    'kode_alternatif' : that.data('alternatifkode'),
                    'alternatif' : that.data('alternatifname'),
                    'preventif' : d.toFixed(4),
                }
                preventif.push(tempData);
            })
            const newArr = preventif.filter((item, index, self) =>
                index === self.findIndex((i) => (
                    i.id_alternatif === item.id_alternatif && i.preventif === item.preventif
                ))
            )
            fixData = newArr;
            newArr.sort((a,b) => parseFloat(b.preventif) - parseFloat(a.preventif));

            var html ;
            newArr.forEach((item, index) =>{
                let i = index +1;
                html += `<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <td>${i}</td>
                            <td>${item.kode_alternatif}</td>
                            <td>${item.alternatif}</td>
                            <td>${item.preventif}</td>
                            </tr>`
                
            })
            $('#tbodyPerangkingan').html(html);
        }


        hitungButton.addEventListener('click', e => {
            e.preventDefault();
            if (document.getElementById('alternatifTable').tBodies[0].rows.length > 1) {
                hitungButton.classList.add('d-none');
                addTable.classList.add('d-none');
                buttonAfter.classList.remove('d-none')  
                hitungDiv.classList.remove('d-none');
                hitungNormalisasiALternatif();
                hitungNormalisasiTerbobot();
                getSolusiIdeal();
                getRanking();
            } else {
                Swal.fire({
                    text: "Total Inventaris yang Ingin Di Cek Harus Lebih dari 1 Inventaris!.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, Mengerti!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    }
                });
            }

        })
    }

    const saveHasil = () => {
        let buttonSave = document.querySelector('[data-kt-maintanance-table-save="save"]');
        buttonSave.addEventListener('click', (e) => {
            e.preventDefault();
            console.log(JSON.stringify(fixData));
            let data = {'aset' : fixData};
            try {
                fetch('/AlgorithmController/addPreventifAset',{
                    method : "POST",
                    body : JSON.stringify(data),
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                }).then(result => {
                    //Successful request processing
                    console.log(result);
                }).catch(error => {
                    console.error('There was an error!', error);
                });
                setTimeout(function () {
                    // Remove loading indication

                    // Show popup confirmation 
                    Swal.fire({
                        text: "Form has been successfully submitted!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Mengerti!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            location.assign('/');
                        }
                    });

                    //form.submit(); // Submit form
                }, 2000);
            } catch (error) {
                
            }
        })
    }

    return {
        // Public functions
        init: function () {
            handleMatrixFuzzyAHP();
            handleVektorTable();
            handleFormFuzzy();
            initAlternatifTotable();
            hitung();
            saveHasil();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    hitungFormMaintanance.init();
});