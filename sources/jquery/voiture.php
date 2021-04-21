<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TP03 - Jeux de voiture</title>
    <style type="text/css">
        #jeu{
            width: 400px;
            height: 400px;
            border: 2px black solid;
            overflow: hidden;
            position: relative;
        }
        .fond{
            margin-bottom:-5px;
            z-index: 10;
            position: relative;
        }
        #vj{
            z-index: 100;
            position: absolute;
            top: 10px;
            left: 48px;
        }
        #vr{
            z-index: 80;
            position: absolute;
            top: -200px;
            left: 0px;
        }

    </style>
</head>
<body>

Collisions : <span id="info">0</span>
<div id="jeu">
    <img id="fond1" class="fond" src="img/route.png">
    <img id="fond2" class="fond" src="img/route.png">
    <img id="vj" src="img/vj.png">
    <img id="vr" src="img/vr.png">
</div>
<audio preload="auto" id="son">
    <source src="sons/beep.mp3" type="audio/mp3">
    <source src="sons/beep.ogg" type="audio/ogg">
</audio>






<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script type="text/javascript" src="js/voiture.js"></script>
</body>
</html>
