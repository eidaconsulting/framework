<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HELLO WORLD</title>
    <style type="text/css">
        #parent {
            width: 300px;
            height:300px;
            position: absolute;
            top: 150px;
            left: 300px;
            background-color: yellow;
        }

        #enfant {
            width: 100px;
            height:100px;
            position: absolute;
            top: 150px;
            left: 100px;
            background-color: red;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<h4>Cliquer sur le point rouge</h4>
<hr>
<div id="parent">
    Texte dans le parent
    <div id="enfant">
        Texte dans l'enfant
    </div>
</div>
<span id="resultat"></span><br>
<span id="position"></span>

<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
