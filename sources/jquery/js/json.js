/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#charger').click(function() {
        $.getJSON('fichier.json', function(donnees) {
            $('#r').html('<p><b>Nom</b> : ' + donnees.nom + '</p>');
            $('#r').append('<p><b>Age</b> : ' + donnees.age + '</p>');
            $('#r').append('<p><b>Ville</b> : ' + donnees.ville + '</p>');
            $('#r').append('<p><b>Domaine de compétences</b> : ' + donnees.domaine + '</p>');
        });
    });
});
