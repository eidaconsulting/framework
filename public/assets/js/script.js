//Gestion des listes
$(function () {
    $('<i class="fa fa-star-o pull-left mt-2"></i>').insertBefore("#list-star li");
    $('<i class="fa fa-caret-right pull-left mt-2"></i>').insertBefore("#list-caret li");
    $('<i class="fa fa-certificate pull-left mt-2"></i>').insertBefore("#list-certificate li");
    $('<i class="fa fa-check pull-left mt-2"></i>').insertBefore("#list-check li");
    $('<i class="fa fa-check-circle pull-left mt-2"></i>').insertBefore("#list-check-circle li");
    $('<i class="fa fa-check-circle-o pull-left mt-2"></i>').insertBefore("#list-check-circle-o li");
    $('<i class="fa fa-check-square-o pull-left mt-2"></i>').insertBefore("#list-check-square-o li");
    $('<i class="fa fa-circle-o pull-left mt-2"></i>').insertBefore("#list-circle-o li");
    $('<i class="fa fa-circle pull-left mt-2"></i>').insertBefore("#list-circle li");
    $('<i class="fa fa-code pull-left mt-2"></i>').insertBefore("#list-code li");
});


<!-- affichage des massage d'alerte -->
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