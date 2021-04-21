/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('select').change(function() {
        $('#resultat').text('Vous venez de sélectionner "' + $(this).val() +'".');
});
});
