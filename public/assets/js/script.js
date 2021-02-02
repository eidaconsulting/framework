$(document).ready(function () {
    $('#alert').slideToggle(500).delay(8000).slideToggle(500);
});

/* GESTION DES AAJAX */
$(function () {
    //Domaine d'activité et activité
    $('#jobscategory_id').change(function () {
        var jobcategorie = $('#jobscategory_id').val();
        var url = 'http://afreeklancepdo/assets/ajax/jobsajax.php?id='+jobcategorie;
        var jobs = $('#jobsid');

        $.ajax({
            url: url,
            success: function (data) {
                // Je charge les données dans box
                jobs.html(data);
            },

            // La fonction à appeler si la requête n'a pas abouti
            error: function() {
                // J'affiche un message d'erreur
                jobs.html("Désolé, aucun métier enrégistré pour ce domaine");
            }
        })

    });
});

/* Function pour afficher le bouton pour remonter vers le haut */
(function(){
    var div = document.querySelector('.is-scroll');
    var back = function (){
        var h = window.scrollY;
        var hasClass = div.classList.contains('opacity')
        if(h > 60 && hasClass){
            div.classList.remove('opacity')
        }
        else if (h < 60 && !hasClass) {
            div.classList.add('opacity')
        }
    }

   window.addEventListener("scroll", back);

    var scrollTop = function (e) {
        e.preventDefault()
        window.scrollTo(0, 0);
    }

    div.addEventListener('click', scrollTop)
})();

/* Cookies */
$(function () {
    //Domaine d'activité et activité
    $ ('#cookiesbtn').click (function (e) {
        e.preventDefault()
        var cookies = $ (".cookies");
        var url = 'http://framework.test/assets/ajax/cookies.php'
        $.ajax ({
            url: url,
            success: function () {
                cookies.hide ();
            },
            error: function () {}
        })

    });
});