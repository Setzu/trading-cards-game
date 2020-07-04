$(function () {
// TODO Récupérer total depuis fichier de conf
    $('#collection-table').DataTable({
        "order": [[ 1, "asc" ]],
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0, 5 ] },
            { "bSearchable": false, "aTargets": [ 0, 5 ] }
        ],
        "language": {
            "paginate": {
                "previous": 'Précédent',
                "next": 'Suivant'
            },
            "search": 'Recherche par mots clés',
            "lengthMenu": 'Afficher _MENU_ cartes par page',
            "sZeroRecords": 'Vous n\'avez pas de cartes',
            "sInfoEmpty": '0/44',
            "sInfoFiltered": '',
            "emptyTable": '',
            "info": 'Vous avez obtenu _TOTAL_/44 cartes'
        }
    });
})