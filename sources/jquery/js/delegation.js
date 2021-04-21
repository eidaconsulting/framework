/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#master').on('click', 'div', function(){
        $(this).after('<div>Ce &lt;div&gt; a les mêmes caractéristiques que son parent</div>');
    });
    $('#suppr').on('click', function() {
        $('#master').off('click','div');
    });
});
