<?php
$router->get('/login', "Users#Login");
$router->post('/login', "Users#Login");
$router->get('/u/login', "Users#Login");
$router->post('/u/login', "Users#Login");

$router->get('/u/activate/:uniqid/:token', "Users#Activate");

$router->get('/u/signup', "Users#Signup");
$router->post('/u/signup', "Users#Signup");

$router->get('/u/index', "Users#Index");

$router->get('/u/password', "Users#Password");
$router->post('/u/password', "Users#Password");

$router->get('/u/signout', "Users#Signout");
$router->get('/u/forgetpw', "Users#Forgetpw");
$router->post('/u/forgetpw', "Users#Forgetpw");
$router->get('/u/forgetactivate/:id/:token', "Users#Forgetactivate");
$router->post('/u/forgetactivate/:id/:token', "Users#Forgetactivate");

