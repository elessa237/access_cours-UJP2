import $ from 'jquery';
import 'bootstrap/dist/js/bootstrap.bundle';
import 'jquery-slimscroll/jquery.slimscroll';
import 'datatables.net/js/jquery.dataTables.min';
import 'datatables.net-responsive/js/dataTables.responsive.min';
import 'datatables.net-bs5/js/dataTables.bootstrap5.min';
import 'datatables.net-responsive-bs5/js/responsive.bootstrap5.min';
import 'select2/dist/js/select2';
import './js/main';
import './js/sidebarMenu';
import './react/elements/element';
import './js/backToTopBtn';
import './app.scss';

window.$ = $;

$('select.custom-select').select2();

let french = {
    "sEmptyTable": "Aucune donnée disponible dans le tableau",
    "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
    "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
    "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
    "sInfoPostFix": "",
    "sInfoThousands": ",",
    "sLengthMenu": "Afficher _MENU_ éléments",
    "sLoadingRecords": "Chargement...",
    "sProcessing": "Traitement...",
    "sSearch": "Rechercher :",
    "sZeroRecords": "Aucun élément correspondant trouvé",
    "oPaginate": {
        "sFirst": "Premier",
        "sLast": "Dernier",
        "sNext": "Suivant",
        "sPrevious": "Précédent"
    },
    "oAria": {
        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
    },
    "select": {
        "rows": {
            "_": "%d lignes sélectionnées",
            "0": "Aucune ligne sélectionnée",
            "1": "1 ligne sélectionnée"
        }
    }
};


$('#datatable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "language": french,
    "pageLength": 20
});