/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('.f').focus(function() {
        $('#resultat').text($(this).attr('id'));
    });
    $('.f').blur(function() {
        $('#resultat2').text($(this).attr('id'));
    });
});
