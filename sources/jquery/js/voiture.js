/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){
    var ok = 1;
    function deplace()
    {
        $('#vr').animate({top: '-=600'}, 2500, 'linear', function(){
            var vrX = Math.floor(Math.random()*194)+70;
            var vrY = 400;
            $('#vr').css('top',vrY);
            $('#vr').css('left',vrX);
            ok = 1;
        });
        $('.fond').animate({top: '-=360'}, 1000, 'linear', function(){
            $('.fond').css('top',0);
            deplace();
        });
    };

    $(document).keydown(function(e){
        if (e.which == 39)
        {
            vjX = parseInt($('#vj').css('left'));
            if (vjX < 280)
                $('#vj').css('left', vjX+30);
        }
        if (e.which == 37)
        {
            vjX = parseInt($('#vj').css('left'));
            if (vjX > 70)
                $('#vj').css('left', vjX-30);
        }
    });

    function collision()
    {
        vjX = parseInt($('#vj').css('left'));
        vrX = parseInt($('#vr').css('left'));
        vjY = 10;
        vrY = parseInt($('#vr').css('top'));
        if (((vrX > vjX) && (vrX < (vjX+66)) && (vrY > vjY) && (vrY < (vjY+150)) && (ok == 1))
            || ((vjX > vrX) && (vjX < (vrX+66)) && (vrY > vjY) && (vrY < (vjY+150)) && (ok == 1)))
        {
            $('#son')[0].play();
            collision = parseInt($('#info').text()) + 1;
            $('#info').text(collision);
            ok = 0;
        }
    }
    deplace();
    setInterval(collision, 20);
});
