/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#enchainer').click( function() {
        $('img').animate({ 'border-width': '100'}, 1500 ).animate({ 'width': '-=100'}, 1500);
    });
    $('#nePasEnchainer').click( function() {
        $('img').animate({ 'border-width': '100'}, { queue: false, duration: 1500 })
            .animate({ 'width': '-=100'}, 1500);
    });
    $('#executerEnMemeTemps').click( function() {
        $('img').animate({ 'border-width': '100', 'width': '-=100' }, 1500);
    });
    $('#etatInitial').click( function() {
        $('img').css({'border-width': '2px', width: '200'});
    });
});
