/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#action').click(function() {
        var param = 'l=' + $('#ref').val();
        $('#r').load('http://localhost/php-poo/jquery/parametre.php',param);
    });
});
