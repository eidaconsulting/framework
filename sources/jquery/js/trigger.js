/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('img').click(function(event,texte) {
        if (texte == undefined)
            texte = "par vous";
        $('#message').text('L\'image a été cliquée ' + texte).fadeIn(1000).fadeOut(1000);
    });
    $('button').click(function() {
        $('img').trigger('click', 'par jQuery');
    });
});
