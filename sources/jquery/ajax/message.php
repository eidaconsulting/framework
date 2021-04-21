<?php
session_start();
//Connexion a la base de données

$pdo = new PDO('mysql:dbname=test_ajax;host=localhost', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("SET CHARACTER SET utf8");


//Recuperation de l'information
$recup = $pdo->query('SELECT * FROM chat ORDER BY add_date DESC LIMIT 0, 5');
$datas = $recup->fetchAll(PDO::FETCH_OBJ);

foreach ($datas as $data): ?>
    <div class="message">
        <span class="texte"><?= $data->msg; ?></span>
        <span class="name"><?= $data->name; ?></span><br>
    </div>
<?php
endforeach;


