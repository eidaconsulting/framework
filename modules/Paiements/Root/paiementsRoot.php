<?php

$router->get('/a/login', "Admins#Login");
$router->post('/a/login', "Admins#Login");
$router->get('/a/index', "Admins#Index");
$router->get('/a/admin', "Admins#Admin");

$router->get('/paiements/a/index', "Admins#Index.paiements");
$router->get('/paiements/a/index/create', "Admins#Index#Create.paiements");
$router->post('/paiements/a/index/create', "Admins#Index#Create.paiements");
$router->get('/paiements/a/index/edit/:id', "Admins#Index#Edit.paiements");
$router->post('/paiements/a/index/edit/:id', "Admins#Index#Edit.paiements");
$router->get('/paiements/a/index/delete/:id', "Admins#Index#Delete.paiements");

$router->get('/paiements', "Publics#Index.paiements");