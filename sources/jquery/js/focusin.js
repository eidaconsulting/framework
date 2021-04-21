/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){

    $('fieldset').focusin(function() {
        $('#resultat3').text($(this).attr('id'));
    });
    $('fieldset').focusout(function() {
        $('#resultat4').text($(this).attr('id'));
    });
});
