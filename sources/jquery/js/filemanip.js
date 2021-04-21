/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#ajouter').click( function() {
        $('#bon').toggle(5000)
            .queue(function() {
                $('#mauvais').animate({left: '+=200'}, 'slow')
                    .animate({top: '+=200'}, 'slow')
                    .animate({left: '-=200'}, 'slow')
                    .animate({top: '-=200'}, 'slow');
            });
    });
    $('#annuler').click( function() {
        $('img').clearQueue();
    });
    $('#remplacer').click( function() {
        $('#mauvais').css('left', 200).css('top', 200);
        $('#mauvais').queue(function() {
            $(this).animate({top: '-=200'}, 'slow')
                .animate({top: '+=200', 'left': '-=200'},
                    'slow')
                .animate({top: '-=200'}, 'slow');
            $(this).dequeue();
        });
    });
    $('#retour').click( function() {
        $('img').queue(function() {
            alert('Animation terminée.');
            $(this).dequeue();
        });
    });
});
