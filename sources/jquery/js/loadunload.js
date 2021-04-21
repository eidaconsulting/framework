/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    alert('La DOM a changé');
    $(window).load(function() {
        alert('La page est entièrement chargée');
    });
    $(window).unload(function() {
        alert('Vous avez demandé à changer de page');
    });
});
