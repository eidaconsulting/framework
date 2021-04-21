/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#action').click(function() {
        var leTexte = $('#texte').val();
        var laPosition = $('#position').val();
        var leResultat = 'Le caractère en position ' + laPosition + ' est un "' + leTexte.charAt(laPosition) + '"';
        $('#resultat').text(leResultat);
    });
});
