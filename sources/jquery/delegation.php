<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Délégation d'evenement</title>
    <style>
        #master > div {
            background:yellow;
            font-weight:bold;
            cursor:pointer;
            padding:8px;
            width: 800px;
            margin: 10px;
        }
    </style>
</head>
<body>
<h1>délégation d'evenement</h1>

<div id="master">
    <div>Cliquez pour insérer un autre &ltdiv&gt</div>
</div>
<button id="suppr">Supprimer la délégation d'événements</button>




<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script type="text/javascript" src="js/delegation.js"></script>
</body>
</html>
