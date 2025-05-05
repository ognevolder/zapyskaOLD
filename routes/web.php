<?php

// Home page
$router->get('/', 'home.php');

// Login
$router->get('/login', 'session/create.php');
$router->post('/login', 'session/store.php');

// Profile
$router->get('/profile', 'profile.php');

// Registration
$router->get('/registration', 'user/create.php');
$router->post('/registration', 'user/store.php');