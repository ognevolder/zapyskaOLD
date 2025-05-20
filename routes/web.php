<?php

// Home
$router->get('/', 'home.php');

// Post
$router->get('/posts/{id}', 'posts/show.php');

// Login
$router->get('/login', 'session/create.php');
$router->post('/login', 'session/store.php');

// Profile
$router->get('/profile', 'profile.php');
$router->get('/{login}', 'user/show.php');

// Registration
$router->get('/registration', 'user/create.php');
$router->post('/registration', 'user/store.php');

// Admin panel
$router->get('/admin', 'admin.php');