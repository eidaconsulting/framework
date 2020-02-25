<?php
//Creation des variables statiques
define('ROOT', dirname(dirname(dirname(__DIR__))));

//Inclusion de fichiers nécessaires
require ROOT . '/vendor/autoload.php';


//Récupération des variables de configuration
$files = dirname(__DIR__) . '/config/config.php';
$config = new Core\Config($files);
$upload = new \Core\Upload\Upload();


$return_value = "";

if ($_FILES['image']['name']) {
    if (!$_FILES['image']['error']) {
        $name = $upload->generateName();
        $ext = explode('.', $_FILES['image']['name']);
        $filename = $name . '' . '' . $ext[1];
        $destination = ROOT . '/public/uploads/summernotes/';
        if (!is_dir($destination)) {
            mkdir(ROOT . '/public/uploads/summernotes/', 0777, true);
        }
        $destination = $destination . $filename;
        $location = $_FILES["image"]["tmp_name"];
        move_uploaded_file($location, $destination);
        $return_value = $config->get('url') . '/uploads/summernotes/' . $filename;
    } else {
        $return_value = 'Ooops! Your upload triggered the following error: ' . $_FILES['image']['error'];
    }
}

echo $return_value;



