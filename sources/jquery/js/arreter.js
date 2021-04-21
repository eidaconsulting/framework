/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $(function() {
        $('img').animate({left: '+=500'}, 2000).animate({top: '+=300'},
            2000);
        $('#stopFin').click( function() {
            $('img').stop(false, true);
        });
        $('#stopAnnuleFin').click( function() {
            $('img').stop(true, true);
        });
        $('#stop').click( function() {
            $('img').stop(true, false);
        });
        $('#reprise').click( function() {
            $('img').css('left', 0).css('top', 0);
            $('img').animate({left: '+=500'}, 2000).animate({top:
                    '+=300'}, 2000);
        });
    });
});
