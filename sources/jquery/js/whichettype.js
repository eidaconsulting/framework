/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    var p = $('#target').offset();
    p.top = 200;
    p.left = 200;
    $('#target').offset(p);

    $('#target').mousedown(function(e){
        var press = e.which;
        if(press == 1){
            var btn = 'Clic gauche';
        }
        else if (press == 2){
            var btn = 'Bouton central';
        }
        else {
            var btn = 'Clic droit';
        }

        $('#rapport').html('Événement : ' + e.type + '. Bouton pressé : ' + btn );
    });
});
