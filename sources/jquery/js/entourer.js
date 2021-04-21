/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('li').wrap('<i></i>');
    $('p.italique').wrapInner('<i></i>'); /* Remplace à l'interieur de la balise selectionnée */
    $('p.text').wrapAll('<div></div>');
});
