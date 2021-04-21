/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#target').keydown(function(){
        $('#lumiere').css('background-color', 'green');
    });
    $('#target').keyup(function(){
        $('#lumiere').css('background-color', 'white');
    });


    $('#saisie').keypress(function(e) {
        $('#unelettre').text(e.which); //keyCode

        var c = String.fromCharCode(e.which);
        $('#unelettre2').text(c);
    });
});
