/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    function Horloge() {
        var laDate = new Date();
        var h = laDate.getHours() + ":" + laDate.getMinutes() + ":" +
            laDate.getSeconds();
        $('#heure').text(h);
    }
    setInterval(Horloge, 1000);
});
