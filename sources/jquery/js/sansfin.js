/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    function bis() {
        $('#balle').animate({left: '+=200'}, 'slow')
            .animate({top: '+=200'}, 'slow')
            .animate({left: '-=200'}, 'slow')
            .animate({top: '-=200'}, 'slow');
    };
    setInterval(bis, 2400);
});
