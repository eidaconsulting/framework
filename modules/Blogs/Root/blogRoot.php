<?php

$router->get('/a/login', "Admins#Login");
$router->post('/a/login', "Admins#Login");
$router->get('/a/index', "Admins#Index");
$router->get('/a/admin', "Admins#Admin");

$router->get('/blogs/a/categories', "Admins#Categories.blogs");
$router->get('/blogs/a/categories/create', "Admins#Categories#Create.blogs");
$router->post('/blogs/a/categories/create', "Admins#Categories#Create.blogs");
$router->get('/blogs/a/categories/edit/:id', "Admins#Categories#Edit.blogs");
$router->post('/blogs/a/categories/edit/:id', "Admins#Categories#Edit.blogs");
$router->get('/blogs/a/categories/delete/:id', "Admins#Categories#Delete.blogs");

$router->get('/blogs/a/index', "Admins#Index.blogs");
$router->get('/blogs/a/index/create', "Admins#Index#Create.blogs");
$router->post('/blogs/a/index/create', "Admins#Index#Create.blogs");
$router->get('/blogs/a/index/edit/:id', "Admins#Index#Edit.blogs");
$router->post('/blogs/a/index/edit/:id', "Admins#Index#Edit.blogs");
$router->get('/blogs/a/index/delete/:id', "Admins#Index#Delete.blogs");

$router->get('/blogs/a/liens', "Admins#Liens.blogs");
$router->post('/blogs/a/liens', "Admins#Liens.blogs");
$router->get('/blogs/a/liens/create', "Admins#Liens#Create.blogs");
$router->post('/blogs/a/liens/create', "Admins#Liens#Create.blogs");
$router->get('/blogs/a/liens/edit/:id', "Admins#Liens#Edit.blogs");
$router->post('/blogs/a/liens/edit/:id', "Admins#Liens#Edit.blogs");
$router->get('/blogs/a/liens/delete/:id', "Admins#Liens#Delete.blogs");

$router->get('/blogs/a/comments', "Admins#Comments.blogs");
$router->get('/blogs/a/comments/delete/:id', "Admins#Comments#Delete.blogs");
$router->get('/blogs/a/comments/published/:id', "Admins#Comments#Published.blogs");
$router->get('/blogs/a/comments/depublished/:id', "Admins#Comments#Depublished.blogs");

$router->get('/blogs', "Publics#Index.Blogs");
$router->get('/blogs/categorie/:slug/:id/page/:page', "Publics#Categories#Pages.Blogs");
$router->get('/blogs/search/:slug/page/:id', "Publics#Recherche#Pages.Blogs");
$router->get('/blogs/categorie/:slug/:id', "Publics#Categories.Blogs");
$router->get('/blogs/page/:id', "Publics#Index#Pages.Blogs");
$router->get('/blogs/:slug/:id', "Publics#Index#Single.Blogs");
$router->post('/blogs/:slug/:id', "Publics#Index#Single.Blogs");
$router->get('/blogs/search', "Publics#Recherche.Blogs");
$router->post('/blogs/search', "Publics#Recherche.Blogs");
$router->post('/blogs/newsletters', "Publics#Newsletters.Blogs");