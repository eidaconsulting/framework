<?php
$router->get('/a/login', "Admins#Login");
$router->post('/a/login', "Admins#Login");

$router->get('/a/index', "Admins#Index");

$router->get('/a/admin', "Admins#Admin");
$router->get('/a/admin/create', "Admins#Admin#Create");
$router->post('/a/admin/create', "Admins#Admin#Create");
$router->get('/a/admin/edit/:id', "Admins#Admin#Edit");
$router->post('/a/admin/edit/:id', "Admins#Admin#Edit");
$router->get('/a/admin/delete/:id', "Admins#Admin#Delete");
$router->post('/a/admin/delete/:id', "Admins#Admin#Delete");

$router->get('/a/password', "Admins#Password");
$router->post('/a/password', "Admins#Password");

$router->get('/a/signout', "Admins#Signout");