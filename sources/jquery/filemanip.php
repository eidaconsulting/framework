<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ANIMATION - Manipulation de la file d'attente</title>
    <style>
        #message { display: none; background-color: yellow; }
    </style>
</head>
<body>
<p>À l'aide de quatre boutons de commande, vous allez pouvoir :
<ul>
    <li>Jouer une animation, puis, lorsqu'elle sera terminée, ajouter d'autres animations dans la file d'attente avec la méthode queue();</li>
    <li>Supprimer le contenu de la file d'attente ;</li>
    <li>Remplacer le contenu de la file d'attente ;</li>
    <li>Ajouter une fonction de retour à la file d'attente</li>
</ul></p>
<button id="ajouter">Ajouter animation</button>
<button id="annuler">Annuler la file d'attente</button><br />
<button id="remplacer">Remplacer la file d'attente</button>
<button id="retour">Ajouter une fonction de retour</button><br />
<img src="img/bon.png" id="bon" style="position: relative;">
<img src="img/mauvais.png" id="mauvais" style="position: relative;">





<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script type="text/javascript" src="js/filemanip.js"></script>
</body>
</html>
