$(() => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle')
    if (sidebarToggle) {
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault()
            document.body.classList.toggle('sb-sidenav-toggled')
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'))
        })
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
    $('#dataTable').show()

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
})
