/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#changement').click(function() {
        $('#un').replaceWith('<img id="unbis" src="img/2.jpg" width="200">');
    });
});
