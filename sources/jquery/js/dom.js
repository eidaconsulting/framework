/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/* HELLO WORLD */
$(function() {
    $('#helloWorld').html('Bonjour monsieur, je suis un code Jquery et vous ?');
});

/* FORMULAIRE */
$(function () {
    $(':input').css('background','yellow');
    $(':password').css('background','#F00');

    /*Focus au premier champ de saisie et coloration en jaune*/
    document.forms[0].nom.focus();
    $(':focus').css('background','#000');
});

/* TABLEAU */
$(function(){
    $('td:first').css('background','#F00');
});

/* PARCOURIR L'ELEMENT */
$(function (){
    $('img').each(function (index) {
        $this.src = 'images2/i' + (index+1) + '.jpg';
    })
})

/* POSITION */
$(function () {

    $('#enfant').click(function () {
        var posenfant = $('#enfant').offset();
        if(posenfant.top == 150 && posenfant.left == 200){
            posenfant.top = 300;
            posenfant.left = 400;
        }
        else {
            posenfant.top = 150;
            posenfant.left = 200;
        }
        $('#enfant').offset(posenfant);
        var posparent = $('#parent').offset();
        var posenfant = $('#enfant').offset();
        var posparent2 = $('#parent').position();
        var posenfant2 = $('#enfant').position();
        $('#position').text('Parent : x=' + posparent2.left + ', y=' + posparent2.top + ' Enfant : x=' + posenfant2.left + ', y=' + posenfant2.top);
        $('#resultat').text('Parent : x=' + posparent.left + ', y=' + posparent.top + ' Enfant : x=' + posenfant.left + ', y=' + posenfant.top);
    })


});

/* DIMENSION */
$(function () {
    var dimensions = 'width=' + $('#dimension').width() + ', innerWidth=' + $('#dimension').innerWidth() + ', outerWidth=' + $('#dimension').outerWidth() + ', outerWidth(true)=' + $('#dimension').outerWidth(true);
    dimensions = dimensions + ', height=' + $('#dimension').height() + ', innerHeight=' + $('#dimension').innerHeight() + ', outerHeight=' + $('#dimension').outerHeight() + ', outerHeight(true)=' + $('#dimension').outerHeight(true);
    $('#resultat-dimension').text(dimensions);
});

$(function () {
    $('h2').append(' ***'); //Ajouter apres
    $('h2').prepend('*** '); //Ajouter avant
    $('#trois').before('<hr>'); //Ajouter au dessus
    $('hr').after('' +
        ''); //Ajouter au dessous
    $('hr').replaceWith('<br>')
    $('<li>Deuxième élément bis</li>').insertAfter($('li:nth-child(2)'));
});
