<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ANIMATION - Un diaporama en deux instructions</title>
    <style type="text/css">
        img { position: absolute; left: 50px; top: 150px; }
        #img1 {z-index: 1;}
        #img2 {z-index: 2;}
        #img3 {z-index: 3;}
        #img4 {z-index: 4;}
        #img5 {z-index: 5;}
        div { margin-top: 30rem}
    </style>
</head>
<body>
<h1>Un diaporama en deux instructions</h1>
<p>réaliser un diaporama basique. Nous allons empiler plusieurs images en les
    faisant disparaître grâce à la méthode fadeOut(). Voici</p>
<div>
    <img src="img/1.jpg" id="img5" width="300">
    <img src="img/2.jpg" id="img4" width="300">
    <img src="img/3.jpg" id="img3" width="300">
    <img src="img/5.jpg" id="img2" width="300">
    <img src="img/6.jpg" id="img1" width="300">
</div>




<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script type="text/javascript" src="js/fadeout.js"></script>
</body>
</html>
