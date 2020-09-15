<?php
ini_set("display_errors", 1);
define ('ROOT', dirname(__DIR__));
require ROOT . '/vendor/autoload.php';

$entity = new \Core\Entity\Entity();

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

include $entity->mega_include("/modules/Roots/adminsRoot");
include $entity->mega_include("/modules/Roots/usersRoot");
include $entity->mega_include("/modules/Blogs/Root/blogRoot");
//include '../modules/Paiements/Root/paiementsRoot.php';

$router->run();
