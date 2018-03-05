<?php
//Creation des variables statiques
define('ROOT', dirname(dirname(dirname(__DIR__))));

//Inclusion de fichiers nécessaires
require ROOT . '/vendor/autoload.php';


//Récupération des variables de configuration
$files = dirname(__DIR__) . '/config/config.php';
$config = new Core\Config($files);
$form = new \Core\Form\BootstrapForm();


$jobscategory_id = (int)htmlentities($_GET['id']);

if ($jobscategory_id != 0) {

    $jobs = App\App::getInstance()->getTable('Job')->extract('id', 'job', ['category_id' => $jobscategory_id]);

    echo $form->select('jobs_id', null, 'Votre métier', [
        'required' => 'required'
    ], $jobs);

} else {
    header('500 Interval Server Error', true, 500);
    die('Aucun metier pour ce domaine d\'activité');
}




