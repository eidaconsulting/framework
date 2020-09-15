(function(){
    var popupCenter = function(url, title, width, height){

        var popupWith = width || 640;
        var popupHeight = height || 320;

        var left = window.screenLeft || window.screenX;
        var top = window.screenTop || window.screenY;

        var windowWidth = window.innerWidth || document.documentElement.clientWidth;
        var windowHeight = window.innerHeight || document.documentElement.clientHeight;

        var popupLeft = left + windowWidth / 2 - popupWith / 2;
        var popupTop = top + windowHeight / 2 - popupHeight / 2;

        window.open(url, title, 'scrollbars=yes, width='+ popupWith +', height='+ popupHeight +', top='+ popupTop +', left='+ popupLeft);
    };

    /*=== Twitter ===*/
    document.querySelector('.share_twitter').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl ="https://twitter.com/intent/tweet?text=" + encodeURIComponent(document.title) +
            "&via=eidaconsulting&url=" + encodeURIComponent(url);

        popupCenter(shareUrl, 'Partager sur Twitter');
    });

    /*=== Facebook ===*/
    document.querySelector('.share_facebook').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl ="https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);

        popupCenter(shareUrl, 'Partager sur Facebook');
    });

    /*=== Google Plus ===*/
    document.querySelector('.share_google').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl ="https://plus.google.com/share?url=" + encodeURIComponent(url);

        popupCenter(shareUrl, 'Partager sur Google');
    });

    /*=== LINKEDIN ===*/
    document.querySelector('.share_linkedin').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl ="https://www.linkedin.com/shareArticle?url=" + encodeURIComponent(url);

        popupCenter(shareUrl, 'Partager sur Linkedin');
    });

    /*=== WHATSAPP ===*/
    document.querySelector('.share_whatsapp').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var shareUrl ="https://wa.me/?text=" + encodeURIComponent(url);

        popupCenter(shareUrl, 'Partager Whatsapp');
    });

})();
