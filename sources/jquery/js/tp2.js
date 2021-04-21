/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    var contenu = $('#contenu');
    var paragraphe = $('#contenu p');
    var pfirst = $('#contenu p:first');

    //Couleur de fond
    $('#couleur-fond').change(function () {
        var color = $('#couleur-fond').val();
        contenu.css('background-color', color);
    });
    /*
    $('#couleur-fond').change(function() {
        var cf = $('#couleur-fond option:selected').val();
        $('#contenu').css('background-color', cf);
    });
    */

    //Modification du texte
    $('#texte').change(function () {
        var style = $('#texte').val();
        if(style == 'Normal'){
            paragraphe.css('font-style', 'normal');
            paragraphe.css('font-weight', 'normal');
            paragraphe.css('text-decoration', 'none');
        }
        else if(style === 'Italique'){
            paragraphe.css('font-style', 'italic');
        }
        else if (style === 'Gras'){
            paragraphe.css('font-weight', 'bold');
        }
        else if (style === 'Souligne'){
            paragraphe.css('text-decoration', 'underline');
        }

    });

    //Police de caractère
    $('#police').change(function () {
        var font = $('#police').val();
        paragraphe.css('font-family', font);
    });

    //Police de premier paragraphe
    $('#police-prem-phrase').change(function () {
        var font = $('#police-prem-phrase').val();
        pfirst.css('font-family', font);
    });


    //Premier caractère de chaque phrase
    $('#prem-car-phrases').change(function () {
        var font = $('#prem-car-phrases option:selected').val();
        if(font == 'Gras'){
            $('p').each(function() {
                var tableau = $(this).text().split('. ');
                if (tableau.length == 1) {}
                else {
                    var tableau2 = $.map(tableau, function(el, ind) {
                        if (el[0] != null) return '<b>' + (el[0]) + '</b>' +
                            el.substring(1) + '. ';
                    });
                    $(this).html(tableau2.join(''));
                }
            });
        }
        if (font == 'Normal'){
            $('p').each(function() {
                var unPar = $(this).html();
                if (unPar.indexOf('<img') == -1)
                    $(this).text($(this).text());
            });
        }
    });


    //MOt en rouge
    $('#couleurMot').click(function() {
        var mot = $('#mot').val();
        var tableau = $('p:first').text().split(' ');
        var tableau2 = $.map(tableau, function(el, ind) {
            if (el == mot) return ('<span style="color:red;">' + el + '</span>');
            else return(el);
        });
        $('p:first').html(tableau2.join(' '));
    });


    //Bordure des images
    $('#bordure-images').change(function() {
        var bi = $('#bordure-images option:selected').val();
        if (bi == 'Rien') $('img').css('border', '2px solid white');
        if (bi == 'Simple') $('img').css('border', '2px solid red');
        if (bi == 'Double') $('img').css('border', '5px double red');
    });

    //Reinitialisation
    $('#raz').click(function() {
        location.reload();
    });

});
