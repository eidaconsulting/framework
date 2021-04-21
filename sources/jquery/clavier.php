<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Clavier</title>
    <style type="text/css">
        #lumiere {
            width: 10px;
            height: 10px;
            background-color: white; }
    </style>
</head>
<body>
<h1>Affiche un cadre vers chaque fois qu'une touche est enfoncée</h1>
<div id="lumiere"></div>
<textarea id="target"></textarea>

<hr>

<h1>Dit la touche qui a été appuyée</h1>
<form>
    Laissez aller votre imagination : saisissez quelques mots<br />
    <textarea id="saisie"></textarea>
</form><br />
Caractère saisi : <span id="unelettre"></span><br>
Caractère saisi : <span id="unelettre2"></span>

<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script type="text/javascript" src="js/clavier.js"></script>
</body>
</html>
