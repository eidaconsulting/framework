<?php

$router->get('/blogs/a/categories', "Admins#Categories.blogs");
$router->get('/blogs/a/categories/create', "Admins#Categories#Create.blogs");
$router->post('/blogs/a/categories/create', "Admins#Categories#Create.blogs");
$router->get('/blogs/a/categories/:id/edit', "Admins#Categories#Edit.blogs");
$router->post('/blogs/a/categories/:id/edit', "Admins#Categories#Edit.blogs");
$router->get('/blogs/a/categories/:id/delete', "Admins#Categories#Delete.blogs");

$router->get('/blogs/a/index', "Admins#Index.blogs");
$router->get('/blogs/a/index/create', "Admins#Index#Create.blogs");
$router->post('/blogs/a/index/create', "Admins#Index#Create.blogs");
$router->get('/blogs/a/index/:id/edit', "Admins#Index#Edit.blogs");
$router->post('/blogs/a/index/:id/edit', "Admins#Index#Edit.blogs");
$router->get('/blogs/a/index/:id/delete', "Admins#Index#Delete.blogs");

$router->get('/blogs/a/liens', "Admins#Liens.blogs");
$router->post('/blogs/a/liens', "Admins#Liens.blogs");
$router->get('/blogs/a/liens/create', "Admins#Liens#Create.blogs");
$router->post('/blogs/a/liens/create', "Admins#Liens#Create.blogs");
$router->get('/blogs/a/liens/:id/edit', "Admins#Liens#Edit.blogs");
$router->post('/blogs/a/liens/:id/edit', "Admins#Liens#Edit.blogs");
$router->get('/blogs/a/liens/:id/delete', "Admins#Liens#Delete.blogs");

$router->get('/blogs/a/comments', "Admins#Comments.blogs");
$router->get('/blogs/a/comments/:id/delete', "Admins#Comments#Delete.blogs");
$router->get('/blogs/a/comments/:id/published', "Admins#Comments#Published.blogs");
$router->get('/blogs/a/comments/:id/depublished', "Admins#Comments#Depublished.blogs");

$router->get('/blogs', "Publics#Index.Blogs");
$router->get('/blogs/categorie/:id/:slug/page/:page', "Publics#Categories#Pages.Blogs");
$router->get('/blogs/search/:id/:slug/page', "Publics#Recherche#Pages.Blogs");
$router->get('/blogs/categorie/:id/:slug', "Publics#Categories.Blogs");
$router->get('/blogs/:id/page', "Publics#Index#Pages.Blogs");
$router->get('/blogs/:id/:slug', "Publics#Index#Single.Blogs");
$router->post('/blogs/:id/:slug', "Publics#Index#Single.Blogs");
$router->get('/blogs/search', "Publics#Recherche.Blogs");
$router->post('/blogs/search', "Publics#Recherche.Blogs");
$router->post('/blogs/newsletters', "Publics#Newsletters.Blogs");