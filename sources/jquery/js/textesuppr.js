/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#action').click(function() {
        var leTexte = $('#texte').val();
        $('#resultat').html('Texte original : "' + leTexte + '"' +
            '<br>Après la fonction trim() : "' +
            $.trim(leTexte) + '"');
    });
});
