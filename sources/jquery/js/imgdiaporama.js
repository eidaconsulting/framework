/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    var i=0;
    affiche();
    function affiche() {
        i++;
        if (i==1) precedent = '#img5'
        else precedent = '#img' + (i-1);
        var actuel = '#img' + i;
        $(precedent).fadeOut(2000);
        $(actuel).fadeIn(2000);
        if (i==5) i=0;
    }
    setInterval(affiche, 3000);
});
