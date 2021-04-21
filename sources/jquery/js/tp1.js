/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    var q = $('.question');
    $('.reponse').hide();

    q.css('background', '#9EEAE0');
    q.css('padding', '15px');
    q.css('margin', '20px');
    q.css('border', '2px solid #000');
    q.css('width', '800px');
    q.css('height', '250px');

    $('.texte').css('float', 'left');
    $('.texte').css('width', '90%');

    $('img').css('float', 'right');
    $('img').css('margin-top', '80px');
    $('img').css('width', '50px');

    $('a').hover(
        function() {
            $('.reponse').show();
            if ($(':radio[id="r1"]:checked').val()) {
                $('#img1').attr('src', 'img/bon.png');
                $('#reponse1').css('color', 'green');
            }
            else {
                $('#img1').attr('src', 'img/mauvais.png');
                $('#reponse1').css('color', 'red');
            }

            if ($(':radio[id="r4"]:checked').val()) {
                $('#img2').attr('src', 'img/bon.png');
                $('#reponse2').css('color', 'green');
            }
            else {
                $('#img2').attr('src', 'img/mauvais.png');
                $('#reponse2').css('color', 'red');
            }

            if ($(':radio[id="r8"]:checked').val()) {
                $('#img3').attr('src', 'img/bon.png');
                $('#reponse3').css('color', 'green');
            }
            else {
                $('#img3').attr('src', 'img/mauvais.png');
                $('#reponse3').css('color', 'red');
            }
        },
        function() {
            $('.reponse').hide();
            $('#img1').attr('src', 'img/question.png');
            $('#img2').attr('src', 'img/question.png');
            $('#img3').attr('src', 'img/question.png');
        }
    );
});
