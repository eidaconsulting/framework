/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#action').click(function() {
        $.ajax({
            type: 'GET',
            url: 'parametre.php?l=7',
            timeout: 3000,
            success: function(data) {
                alert(data); },
            error: function() {
                alert('La requête n\'a pas abouti'); }
        });
    });
});
