/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('.miniature').css('border','5px white solid');
    $('img:first').css('border','5px black solid');
    $('.miniature').click(function() {
        $('img').css('border','5px white solid');
        $(this).css('border','5px black solid');
        var nom = $(this).attr('src');
        $('#grand').attr('src',nom);
    });
});
