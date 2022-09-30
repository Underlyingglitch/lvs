/*!
    * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2022 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

// window.addEventListener('DOMContentLoaded', event => {

//     // Toggle the side navigation
//     // const sidebarToggle = document.body.querySelector('#sidebarToggle');
//     // if (sidebarToggle) {
//     //     // Uncomment Below to persist sidebar toggle between refreshes
//     //     // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
//     //     //     document.body.classList.toggle('sb-sidenav-toggled');
//     //     // }
//     //     sidebarToggle.addEventListener('click', event => {
//     //         event.preventDefault();
//     //         document.body.classList.toggle('sb-sidenav-toggled');
//     //         localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
//     //     });
//     // }
//     // const datatablesSimple = document.getElementById('dataTable');
//     // if (datatablesSimple) {
//     //     new simpleDatatables.DataTable(datatablesSimple);
//     // }

// });

$(() => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    $('#dataTable').DataTable({
        "language": {
            "decimal": "",
            "emptyTable": "Geen data beschikbaar",
            "info": "_START_ t/m _END_ van _TOTAL_ items zichtbaar",
            "infoEmpty": "0 items beschikbaar",
            "infoFiltered": "(gefilterd van _MAX_ items)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Toon _MENU_ items",
            "loadingRecords": "Laden...",
            "processing": "",
            "search": "Zoeken:",
            "zeroRecords": "Geen overeenkomsten gevonden",
            "paginate": {
                "first": "Eerste",
                "last": "Laatste",
                "next": "Volgende",
                "previous": "Vorige"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    })
    $('#dataTable').show();
})
