/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $(function() {
        function bis() {
            $('#balle').animate({top: '+=200', left: '+=200'}, 'slow')
                .animate({top: '-=200', left: '+=200'}, 'slow')
                .animate({top: '+=200', left: '+=200'}, 'slow')
                .animate({top: '-=200', left: '+=200'}, 'slow')
                .animate({top: '+=200', left: '+=200'}, 'slow')
                .animate({top: '-=200', left: '+=200'}, 'slow')

                .animate({top: '+=200', left: '-=200'}, 'slow')
                .animate({top: '-=200', left: '-=200'}, 'slow')
                .animate({top: '+=200', left: '-=200'}, 'slow')
                .animate({top: '-=200', left: '-=200'}, 'slow')
                .animate({top: '+=200', left: '-=200'}, 'slow')
                .animate({top: '-=200', left: '-=200'}, 'slow', bis);
        };
        bis();
    });
});
