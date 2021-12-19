import 'jquery';
import $ from 'jquery';
import 'popper.js';
import 'bootstrap/dist/js/bootstrap.min';
import 'datatables.net/js/jquery.dataTables';
import 'jquery-slimscroll/jquery.slimscroll';
import 'datatables.net-bs4/js/dataTables.bootstrap4';
import 'feather-icons/dist/feather.min.js';
import 'prismjs/components/prism-core.min.js';
import 'prismjs/components/prism-markup.min.js';
import 'prismjs/plugins/line-numbers/prism-line-numbers.min.js';
import './js/main';
import './js/sidebarMenu';
import './js/feather';
import './js/copyButton';
import './styles/app.scss';
import 'select2/dist/js/select2';
$('select').select2();

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
}
$(document).ready(function() {
    $('#datatable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "language" : french,
    });
} );