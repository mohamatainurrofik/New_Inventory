"use strict";

const contentHandle = function () {
    let table = document.querySelector('#priorityTable');
    let table1 = document.querySelector('#allActivityTable');
    let datatable ;
    let datatable1 ;


    const initMaintananceTable = () => {
        datatable = $(table).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/DashboardController/listMaintananceAsetPriority` ,
                "dataSrc" : "",
            },
            "pageLength": 5,
            "lengthChange": false,
            "columns": [
                {"data" : 'id_detailunit'},
                {"data" : 'kode'},
                {"data" : 'nama_unit'},
                {"data" : 'foto_unit'},
            ],
            'order': [[3, 'DESC']],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    visible :false,
                    render: function (data, type, row, meta) {
                        return meta.row+1;
                    },
                },
                {
                    targets: 1,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return `<a style="text-decoration: none;" href="/Data/inventaris/${row['id_detailunit']}">${data}</a>`;
                    },
                },

            ]
        });

        datatable.on('draw', function () {
        });
    }


    const initActivityTable = () => {
        datatable1 = $(table1).DataTable({
            "ajax": {
                "url" :`${document.location.origin}/DashboardController/listAllActivity` ,
                "dataSrc" : "",
            },
            "pageLength": 5,
            "lengthChange": false,
            "columns": [
                {"data" : 'created_at'},
                {"data" : 'created_by'},
                {"data" : 'description'},
                {"data" : 'before'},
                {"data" : 'after'},

            ],
            'order': [[0, 'DESC']],
        });

        datatable.on('draw', function () {
        });
    }



    const handleButtonDashboard = () => {
        let button1 = document.querySelector('[data-priority-button="priority"]');
        let button2 = document.querySelector('[data-activity-button="activity"]');
        let priority = document.querySelector('#priorityList');
        let activity = document.querySelector('#activityList');
        button2.addEventListener('click', (e) => {
            e.preventDefault();
            priority.classList.add('d-none');
            activity.classList.remove('d-none');
        })
        button1.addEventListener('click', (e) => {
            e.preventDefault();
            priority.classList.remove('d-none');
            activity.classList.add('d-none');
        })

    }
   



    

    return {
        // Public functions  
        init: () => {
            initMaintananceTable();
            initActivityTable();
            handleButtonDashboard();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    contentHandle.init();
});