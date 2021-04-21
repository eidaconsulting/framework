<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Clavier</title>
    <style type="text/css">
        #lumiere {
            width: 10px;
            height: 10px;
            background-color: white;
        }
    </style>
</head>
<body>
<h1>Focus() et Blur()</h1>
<form>
    Cliquez sur les zones de texte<p>
        <input type="text" class="f" id="Zone-de-texte-1">
    <p>
        <input type="text" class="f" id="Zone-de-texte-2"><br/>
</form>
<br/>
Focus : <span id="resultat"></span><br/>
Perte de focus : <span id="resultat2"></span>





<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script type="text/javascript" src="js/focusblur.js"></script>
</body>
</html>
