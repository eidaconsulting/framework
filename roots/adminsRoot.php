<?php
$router->get('/a/login', "Admins#Login");
$router->post('/a/login', "Admins#Login");

$router->get('/a/index', "Admins#Index");

//Type de compte
$router->get('/a/comptes-types', "Admins#ComptesTypes");
$router->post('/a/comptes-types', "Admins#ComptesTypes");
$router->get('/a/comptes-types/:id/:slug', "Admins#ComptesTypes");
$router->post('/a/comptes-types/:id/:slug', "Admins#ComptesTypes");

//Catégories
$router->get('/a/categories', "Admins#Categories");
$router->post('/a/categories', "Admins#Categories");
$router->get('/a/categories/:id/:slug', "Admins#Categories");
$router->post('/a/categories/:id/:slug', "Admins#Categories");

//Comptes
$router->get('/a/comptes', "Admins#Comptes");
$router->post('/a/comptes', "Admins#Comptes");
$router->get('/a/comptes/:id/:slug', "Admins#Comptes");
$router->post('/a/comptes/:id/:slug', "Admins#Comptes");

//Encaissements
$router->get('/a/encaissements', "Admins#Encaissements");
$router->post('/a/encaissements', "Admins#Encaissements");
$router->get('/a/encaissements/:id/:slug', "Admins#Encaissements");
$router->post('/a/encaissements/:id/:slug', "Admins#Encaissements");

//Encaissements
$router->get('/a/decaissements', "Admins#Decaissements");
$router->post('/a/decaissements', "Admins#Decaissements");
$router->get('/a/decaissements/:id/:slug', "Admins#Decaissements");
$router->post('/a/decaissements/:id/:slug', "Admins#Decaissements");

//Clients
$router->get('/a/clients', "Admins#Clients");
$router->post('/a/clients', "Admins#Clients");
$router->get('/a/clients/:id/:slug', "Admins#Clients");
$router->post('/a/clients/:id/:slug', "Admins#Clients");

$router->get('/a/admin', "Admins#Admin");
$router->get('/a/admin/create', "Admins#Admin#Create");
$router->post('/a/admin/create', "Admins#Admin#Create");
$router->get('/a/admin/:id/edit', "Admins#Admin#Edit");
$router->post('/a/admin/:id/edit', "Admins#Admin#Edit");
$router->get('/a/admin/delete/:id', "Admins#Admin#Delete");
$router->post('/a/admin/delete/:id', "Admins#Admin#Delete");

$router->get('/a/password', "Admins#Password");
$router->post('/a/password', "Admins#Password");

$router->get('/a/signout', "Admins#Signout");
