"use strict";

const updateMatrikPairwise = function () {
    let table = document.querySelector('#pairwiseTable');
    let syntetisTable = document.querySelector('#SummaryPairwiseTable')
    let changeButton = document.querySelector('[data-kt-ubah-matrikpairwise="pairwise"]');
    const form = document.querySelector('#kt_ubah_pairwise_kriteria');
    const updateValue = () => {
        let leftColumn = form.pairwise_leftcolumn;
        let rightColumn = form.pairwise_rightcolumn;
        let cI = document.querySelector('#consistencyIndex');
        let cR = document.querySelector('#consistencyRatio');
        let iR = document.querySelector('#ratioIndex');
        let status = document.querySelector('#statusBobot');
        let saveButton = document.querySelector('#saveBobotKriteria');
        let fuzzy_set = form.fuzzy_set;
        sumCellValue();
        sumSyntetisValue();
        sumCellWeightValue();

        function setCellValue ( rowId, colNum, newValue) {
            $('#pairwiseTable').find('td[data-rowKriteria="'+rowId+'"][data-colKriteria="'+colNum+'"]').html(newValue);
            $('#pairwiseTable').find('td[data-rowKriteria="'+colNum+'"][data-colKriteria="'+rowId+'"]').html(parseFloat(1/newValue).toFixed(4));
        };



        function setCellSyntetisValue ( rowId, colNum, newValue) {
            $('#SummaryPairwiseTable').find('td[data-rowSummaryKriteria="'+rowId+'"][data-colSummaryKriteria="'+colNum+'"]').html(newValue);
        };


        function sumCellWeightValue(){
            $('#SummaryPairwiseTable tbody tr td.bobotkriteria').each(function(){
                let that = $(this);
                let sum = 0;
                let count = 0;
               $('#SummaryPairwiseTable').find('td[data-rowSummaryKriteria="'+that.data('bobot')+'"]').each(function() {
                   sum += parseFloat($(this).html());
                   console.log(sum);
                   count++;
               });
               that.html((sum/count).toFixed(4));
            })
            getConcistency();
        }


        function sumCellValue() {
            $('#pairwiseTable tbody tr td.sumPairWise').each(function(){
                let that = $(this);
                let sum = 0;
               $('#pairwiseTable').find('td[data-colKriteria="'+that.data('sum')+'"]').each(function() {
                   sum += parseFloat($(this).html());
               });
               that.html(sum.toFixed(4));
            })
        }

        function sumSyntetisValue()
        {
            $('#SummaryPairwiseTable tbody tr td:not(:first-child)').each(function(){
                let cellValue = $('#pairwiseTable').find('td[data-rowKriteria="'+$(this).data('rowsummarykriteria')+'"][data-colKriteria="'+$(this).data('colsummarykriteria')+'"]').html();
                let sumCellValue = $('#pairwiseTable').find('td[data-sum="'+$(this).data('colsummarykriteria')+'"]').html();
                let value = parseFloat(cellValue)/ parseFloat(sumCellValue);
                setCellSyntetisValue($(this).data('rowsummarykriteria'), $(this).data('colsummarykriteria'), value.toFixed(4));
            })
        }

        function getConcistency()
        {
            let lamdaMax= 0;
            let count = 0;
            let tempCi = 0;
            let tempCr = 0;
            let tempIr = 0;
            $('#SummaryPairwiseTable tbody tr td.bobotkriteria').each(function(){
                let cellBobot = $('#pairwiseTable').find('td[data-sum="'+$(this).data('bobot')+'"]').html();
                lamdaMax += (parseFloat(cellBobot)*parseFloat($(this).html()));
                // console.log(`${parseFloat(cellBobot)}*${parseFloat($(this).html())}`);
                count++;
            })
            if (count == 1 || count == 2) {
                tempIr = 0;
            }else if(count == 3){
                tempIr = 0.58;
            }else if(count == 4){
                tempIr = 0.90;
            }else if(count == 5){
                tempIr = 1.12;
            }else if(count == 6){
                tempIr = 1.24;
            }else if(count == 7){
                tempIr = 1.32;
            }else if(count == 8){
                tempIr = 1.41;
            }else if(count == 9){
                tempIr = 1.45;
            }else if(count == 10){
                tempIr = 1.49;
            }
            tempCi= (lamdaMax-count)/(count-1);
            tempCr = tempCi/tempIr;
            if (tempCr<0.1) {
                status.innerHTML = '(Konsisten)';
            } else {
                status.innerHTML = '(Tidak Konsisten)';
            }

            cI.innerHTML = tempCi.toFixed(4);
            iR.innerHTML = tempIr;
            cR.innerHTML = tempCr.toFixed(4);
            if (tempCr < 0.1) {
                saveButton.classList.remove('d-none');
            } else {
                saveButton.classList.add('d-none');
            }
        }

        changeButton.addEventListener('click', (e) => {
            e.preventDefault();


            if (leftColumn.value == rightColumn.value && fuzzy_set.value != 1) {
                Swal.fire({
                    text: "Perbandingan Kolom dan baris yang sama harus equal = 1",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, Mengerti!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    }
                });
            } else {
                setCellValue(leftColumn.options[leftColumn.selectedIndex].dataset.kode, rightColumn.options[rightColumn.selectedIndex].dataset.kode, fuzzy_set.value);
                sumCellValue();
                sumSyntetisValue();
                sumCellWeightValue();
                Swal.fire({
                    text: "Bobot Berhasil Diubah!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, Mengerti!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function (result) {
                    if (result.isConfirmed) {
                        modal.hide();
                    }
                });
                // console.log(leftColumn[form.leftColumn.selectedIndex].dataset.kode);
                // console.log(rightColumn[form.rightColumn.selectedIndex].dataset.kode);

            }
        })
        

    }

    const updateValueToDatabase = () => {
        let status = document.querySelector('#statusBobot');
        let buttonSave= document.querySelector('#saveBobotKriteria');
        let dataPairWise = [];
        let dataBobot = [];
        buttonSave.addEventListener('click', e => {
            e.preventDefault();
            if (status.innerHTML == '(Tidak Konsisten)') {
                Swal.fire({
                    text: "Bobot yang di Set tidak Konsisten !!.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, Mengerti!",
                    customClass: {
                        confirmButton: "btn fw-bold btn-primary",
                    }
                });
            } else {
                try {
                    $('#SummaryPairwiseTable tbody tr td:last-child').each(function(row,td){
                        let tempBobot = {
                            'kriteria_kode' : $(this).attr('data-bobot'),
                            'value' : parseFloat($(this).html()),
                            'deskripsi' : '',
                        }
                        dataBobot.push(tempBobot);
                    })

                    $('#pairwiseTable tbody tr:not(:last-child) td:not(:first-child)').each(function(row,td){
                        let tempData = {
                            'fuzzy_id' : parseInt($(this).html()), 
                            'kriteria_kolom' : $(this).attr('data-rowKriteria'), 
                            'kriteria_baris' : $(this).attr('data-colKriteria'), 
                            'value' : parseFloat($(this).html()),
                            'deskripsi' : '',  
                        }
                        dataPairWise.push(tempData);
                    })
                    let data1 = {  'bobot' : dataBobot ,'pairwise' : dataPairWise};
                    fetch('/AlgorithmController/bobotKriteriaUpdate',{
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
                            text: "Bobot Berhasil Disimpan!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, Mengerti!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                location.assign('/Fahp/kriteriabobot');
                            }
                        });
                        //form.submit(); // Submit form
                    }, 1000);
                } catch (error) {
                    
                }
            }

        })

    }

    return {
        // Public functions  
        init: () => {
            if (!table) {
                return;
            }

            updateValue();
            updateValueToDatabase();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    updateMatrikPairwise.init();
});