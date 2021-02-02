$(function(){
    $('#summernote').summernote({
        lang: 'fr-FR',
        dialogsInBody: true,
        height: 300,
        minHeight: null,
        maxHeight: null,
        shortCuts: false,
        disableDragAndDrop: false,
        toolbar: [
            ['fontsize', ['style', 'fontsize', 'fontname']],
            ['style', ['bold', 'italic', 'underline', 'clear', 'hr']],
            ['para', ['ul', 'ol', 'paragraph', 'height']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['color', ['color']],
            ['link', ['link']],
            ['insert', ['picture', 'video', 'table']],
            ['undo', ['undo']],
            ['redo', ['redo']],
            ['Other', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onImageUpload: function(image) {
                editor = $(this);
                uploadImageContent(image[0], editor);
            }
        },
        cleaner:{
              action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
              newline: '<br>', // Summernote's default is to use '<p><br></p>'
              notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
              icon: '<i class="note-icon">[Your Button]</i>',
              keepHtml: false, // Remove all Html formats
              keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'], // If keepHtml is true, remove all tags except these
              keepClasses: false, // Remove Classes
              badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
              badAttributes: ['style', 'start'], // Remove attributes from remaining tags
              limitChars: false, // 0/false|# 0/false disables option
              limitDisplay: 'both', // text|html|both
              limitStop: false // true/false
        }
    });
});



function uploadImageContent(image, editor) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
        url: "http://framework.test/assets/ajax/summernotes.php",
    cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
    success: function(url) {
        var image = $('<img>').attr('src', url);
        $(editor).summernote("insertNode", image[0]);
    },
    error: function(data) {
        console.log(data);
    }
});
}
