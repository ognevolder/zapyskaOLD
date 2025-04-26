<?php

// Home page
$router->get('/', 'home.php');

// Login && Profile
$router->get('/login', 'login.php');
$router->get('/profile', 'profile.php');

// Registration
$router->get('/registration', 'registration.php');