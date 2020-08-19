(function(){
    var btn = $('#comment-btn');
    var comment = $('#comment-form');
    var forget = $('#comment-forget');
    btn.click(function(e){
        e.preventDefault();
        comment.slideToggle(500);
        btn.slideToggle(0);
        forget.slideToggle(500);
    });
    forget.click(function(e){
        e.preventDefault();
        comment.slideToggle(500);
        btn.slideToggle(500);
        forget.slideToggle(0);
    });

})();
