$(document).ready( function () {
    // TODO Récupérer total depuis BDD
    $('#collection-table').DataTable({
        "language": {
            "paginate": {
                "previous": 'Précédent',
                "next": 'Suivant'
            },
            "search": 'Recherche par mots clés',
            "lengthMenu": 'Afficher _MENU_ cartes par page',
            "sZeroRecords": 'Vous n\'avez pas de cartes',
            "sInfoEmpty": '0 message en attente de réponse',
            "sInfoFiltered": '',
            "emptyTable": '',
            "info": 'Vous avez obtenu _TOTAL_/39 cartes'
        }
    });
} );