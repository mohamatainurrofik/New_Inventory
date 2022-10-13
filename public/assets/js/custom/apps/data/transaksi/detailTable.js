"use strict";

const inventarisList = function () {
    let table = document.querySelector('#inventarisTable');
    let datatable ;

    const cetakTransaksi = () => {
        let buttonCetak = document.querySelector('[data-unique="cetak"]');
        let id = document.querySelector('#id_detailorder').value;
        buttonCetak.addEventListener('click', (e) => {
            e.preventDefault();
            console.log(e);
            try {
                fetch('/OrderController/cetak',{
                    method : "POST",
                    body : JSON.stringify({id}) ,
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                })
                .catch((error) => {
                  console.error('Error:', error);
                });
            } catch (error) {
                
            }
        })
    }
   
    return {
        // Public functions  
        init: () => {
            cetakTransaksi();

           
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    inventarisList.init();
});