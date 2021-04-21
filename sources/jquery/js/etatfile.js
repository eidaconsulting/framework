/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#droite').click( function() {
        $('img').animate({left: '+=50'}, 2000);
    });
    $('#gauche').click( function() {
        $('img').animate({left: '-=50'}, 2000);
    });
    $('#bas').click( function() {
        $('img').animate({top: '+=50'}, 2000);
    });
    $('#haut').click( function() {
        $('img').animate({top: '-=50'}, 2000);
    });
    $('#etatFile').click(function() {
        var n = $('img').queue();
        $('#infos').text('Nombre d\'animations dans la file d\'attente : ' + n.length);
    });
});
