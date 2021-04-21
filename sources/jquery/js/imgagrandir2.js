/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#montagnePetit').mouseover(function() {
        $(this).fadeOut(1000);
        $('#montagneGrand').fadeIn(1000);
    });
    $('#montagneGrand').mouseout(function() {
        $(this).fadeOut(1000);
        $('#montagnePetit').fadeIn(1000);
    });
});
