/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    $('#action').click(function() {
        $(document).ajaxStart(function() {
            $('#message').html('Méthode ajaxStart exécutée<br>');
        });
        $(document).ajaxSend(function(ev, req, options){
            $('#message').append('Méthode ajaxSend exécutée, ');
            $('#message').append('nom du fichier : ' + options.url + '<br>');
        });
        $(document).ajaxStop(function(){
            $('#message').append('Méthode ajaxStop exécutée<br>');
        });
        $(document).ajaxSuccess(function(ev, req, options){
            $('#message').append('Méthode ajaxSuccess exécutée<br>');
        });
        $(document).ajaxComplete(function(ev, req, options){
            $('#message').append('Méthode ajaxComplete exécutée<br>');
        });
        $(document).ajaxError(function(ev, req, options, erreur){
            $('#message').append('Méthode ajaxError exécutée, ');
            $('#message').append('erreur : ' + erreur + '<br>');
        });
        $('#donnees').load('affiche.php');
    });
});
