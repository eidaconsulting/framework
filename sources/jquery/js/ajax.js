/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#majPremier').click(function() {
        $('#premier').load('maj1.php', function() {
            alert('La première zone a été mise à jour');
        });
    });

    $('#majDeuxieme').click(function() {
        $('#deuxieme').load('maj2.php', function() {
            alert('La deuxième zone a été mise à jour');
        });
    });

    $('#majTroisieme').click(function() {
        $('#exampleModal').modal('toggle');
    });

    $('#majQuatrieme').click(function() {
        $('#exampleModal').modal('hide');
        $('#MyModal').modal('show');
    });
});
