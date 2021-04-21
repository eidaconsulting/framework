<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TP02 - Supprimer de l'espace dans un texte</title>
    <style type="text/css">
        #contenu
        {
            width: 500px;
            height: 450px;
            border: 1px black solid;
            float: left;
            margin-right: 10px;
            overflow-y: auto;
        }
        #controles
        {
            width: 300px;
            height: 450px;
            border: 1px black solid;
            float: left;
        }
        #controles div{
            margin-bottom: 10px;
            padding: 5px;
        }
        label{
            float: left;
            width: 140px;
        }
        #image
        {
            width: 110px;
            height: 110px;
            margin-left: 100px;
        }
        p
        {
            padding-left: 5px;
            padding-right: 5px;
            font-family: 'Times New Roman';
        }
    </style>
</head>
<body>
<div id="contenu">
    <p>At vero eos et accusamus et iusto odio dignissimos ducimus
        qui blanditiis praesentium voluptatum deleniti atque corrupti quos
        dolores et quas molestias excepturi sint occaecati cupiditate non
        provident, similique sunt in culpa qui officia deserunt mollitia
        animi, id est laborum et dolorum fuga. </p>
    <div id="image"><img src="img/5.jpg" width="180"></div>
    <p>Et harum quidem rerum facilis est et expedita distinctio.
        Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
        impedit quo minus id quod maxime placeat facere possimus, omnis
        voluptas assumenda est, omnis dolor repellendus. Temporibus autem
        quibusdam et aut officiis debitis aut rerum necessitatibus saepe
        eveniet ut et voluptates repudiandae sint et molestiae non
        recusandae. </p>
    <p>Itaque earum rerum hic tenetur a sapiente delectus, ut aut
        reiciendis voluptatibus maiores alias consequatur aut perferendis
        doloribus asperiores repellat. </p>
</div>
<div id="controles">
    <div>
        <label for="couleur-fond">Couleur de fond</label>
        <select id="couleur-fond">
            <option value="#FFFFFF">Blanc</option>
            <option value="#9FFEF1">Bleu</option>
            <option value="#9FFECE">Vert</option>
            <option value="#FAFE9F">Jaune</option>
        </select>
    </div>
    <div>
        <label for="texte">Texte</label>
        <select id="texte">
            <option value="Normal">Normal</option>
            <option value="Gras">Gras</option>
            <option value="Italique">Italique</option>
            <option value="Souligne">Souligné</option>
        </select>
    </div>
    <div>
        <label for="police">Police</label>
        <select id="police">
            <option value="Times New Roman">Times New Roman</option>
            <option value="Courier New">Courier New</option>
            <option value="Arial">Arial</option>
        </select>
    </div>
    <div>
        <label for="police-prem-phrase">Police 1e phrase</label>
        <select id="police-prem-phrase">
            <option value="Times New Roman">Times New Roman</option>
            <option value="Courier New">Courier New</option>
            <option value="Arial">Arial</option>
        </select>
    </div>
    <div>
        <label for="prem-car-phrases">Prem caract phrases</label>
        <select id="prem-car-phrases">
            <option value="Normal">Normal</option>
            <option value="Gras">Gras</option>
        </select>
    </div>
    <div>
        <label for="mot">Mot en rouge</label>
        <input type="text" id="mot" size="2">
        <button id="couleurMot">OK</button>
    </div>
    <div>
        <label for="bordure-images">Bordure images</label>
        <select id="bordure-images">
            <option value="Rien">Rien</option>
            <option value="Simple">Simple</option>
            <option value="Double">Double</option>
        </select>
    </div>
    <div>
        <button id="raz">RAZ formulaire</button>
    </div>
</div>





<!-- Une ou plusieurs balises HTML pour définir le contenu du document -->
<script src="js/jquery.min.js" rel="script" type="text/javascript"></script>
<script type="text/javascript" src="js/tp2.js"></script>
</body>
</html>
