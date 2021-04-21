/* Initialiser Jquery */
/*jQuery(document).ready(function () {

});

$(document).ready(function () {

});*/

/*DEPLACER UN PRODUIT*/
$(function(){

    $('#send').click(function (e) {
        e.preventDefault();
        var name = $('#name').val();
        var msg = $('#msg').val();
        $.post('ajax/chat.php', {
            'name': name,
            'msg': msg
        }, afficheConversation);

        function afficheConversation() {
            $('#message-zone').load('ajax/message.php');
            $('#msg').val('');
            $('#msg').focus();
        }
        setInterval(afficheConversation, 5000);

    });
});
