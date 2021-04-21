/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('img').one('click', function() {
        $('#message').text('Vous avez cliqué sur l\'image. Désormais, je resterai insensible aux clics.').fadeIn(3000).fadeOut(8000);
    });
});
