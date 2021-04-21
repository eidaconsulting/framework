/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#msg').hide();

    // Dimensions de la fenêtre
    var largeur = ($(window).width()) - 100;
    var hauteur = ($(window).height()) - 100;

    // Affichage de la première image en (100, 100)
    var p = $('#target').offset();
    p.top=100;
    p.left=100;
    $('#target').offset(p);

    $('#target').mouseover(
        function () {
            $('#msg').hide();

            x = Math.floor(Math.random()*largeur);
            y = Math.floor(Math.random()*hauteur);

            var p = $('#target').offset();
            p.top = y;
            p.left = x;
            $('#target').offset(p);
        }
    );

    $('#target').click(
        function () {
            var p = $('#target').offset();
            p.top = 200;
            p.left = 200;
            $('#target').offset(p);

            $('#msg').show();
        }
    );
});
