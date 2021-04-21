<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ANIMATION - animate</title>
    <style>
        #message { display: none; background-color: yellow; }
    </style>
</head>
<body>
<p>Nous allons appliquer deux animations à une image : la première
    augmentera progressivement la largeur de la bordure et la deuxième diminuera progressivement la taille de l'image</p>

<button id="enchainer">Enchaîner les animations</button>
<button id="nePasEnchainer">Ne pas enchaîner les animations</button><br />
<button id="executerEnMemeTemps">Exécuter les animations en même temps</button>
<button id="etatInitial">État initial</button><br /><br />
<img src="img/bon.png" style="border: 2px black solid;">





<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script type="text/javascript" src="js/animate.js"></script>
</body>
</html>
