$(function () {
// TODO Récupérer total depuis fichier de conf
    var table = $('#reception-table').DataTable({
        "order": [[ 1, "asc" ]],
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0, 6 ] },
            { "bSearchable": false, "aTargets": [ 0, 6 ] }
        ],
        "language": {
            "paginate": {
                "previous": 'Précédent',
                "next": 'Suivant'
            },
            "search": 'Recherche par mots clés',
            "lengthMenu": 'Afficher _MENU_ messages par page',
            "sZeroRecords": 'Vous n\'avez pas de nouveau message',
            "sInfoEmpty": '0 message reçu',
            "sInfoFiltered": '',
            "emptyTable": '',
            "info": 'Vous avez _TOTAL_ messages'
        }
    });
});
