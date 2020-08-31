<?php
ini_set("display_errors", 1);
date_default_timezone_set('Africa/Porto-Novo');
define ('ROOT', dirname(__DIR__));
require ROOT . '/vendor/autoload.php';

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_GET['url'])) {
    $_GET['url'] = null;
}

$router = new \Core\Router\Router($_GET['url']);
$router->get('/', 'Publics#index');
$router->get('/404', 'Publics#notfound');
$router->get('/databases/create', 'Publics#databases');
$router->get('/contacts', 'Publics#contacts');
$router->post('/contacts', 'Publics#contacts');


include '../modules/Roots/adminsRoot.php';
include '../modules/Roots/usersRoot.php';
include '../modules/Blogs/Root/blogRoot.php';
//include '../modules/Paiements/Root/paiementsRoot.php';

$router->run();
