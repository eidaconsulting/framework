/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#montagne').mouseover(function() {
        $(this).attr('src','img/3.jpg');
        $(this).attr('width','500');
    });
    $('#montagne').mouseout(function() {
        $(this).attr('src','img/3.jpg');
        $(this).attr('width','200');
    });
});
