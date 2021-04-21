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
<h1>focusin() et focusout()</h1>
<form>
    Cliquez sur les zones de texte
        <fieldset id="premier">
            <legend>Premier groupe</legend>
            <input type="text" class="f" id="Zone-de-texte-1">
            <input type="text" class="f" id="Zone-de-texte-2"><br/>
        </fieldset>
        <fieldset id="deuxieme">
            <legend>Deuxième groupe</legend>
            <input type="text" class="f" id="Zone-de-texte-3">
            <input type="text" class="f" id="Zone-de-texte-4"><br/>
        </fieldset>
</form>
<br/>
Focus : <span id="resultat3"></span><br/>
Perte de focus : <span id="resultat4"></span>




<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script type="text/javascript" src="js/focusin.js"></script>
</body>
</html>
