/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#affiche').click(function() {
        $('img').first().show('slow', function showNextOne() {
            $(this).next('img').show('slow', showNextOne);
        });
    });
    $('#cache').click(function() {
        $('img').first().hide('slow', function hideNextOne() {
            $(this).next('img').hide('slow', hideNextOne);
        });
    });
});
