/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $(window).resize(function () {
        var taille = 'Taille de la fenetre : '+ $(window).width() +' px ' +
            'x '+ $(window).height() +' px';
        $('#resultat').text(taille);
    });
});
