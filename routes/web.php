<?php

// Home
$router->get('/', 'home.php');

// Login
$router->get('/login', 'session/create.php')->only('guest');
$router->post('/login', 'session/store.php')->only('guest');

// Profile (private)
$router->get('/profile', 'user/index.php')->only('auth');

// Registration
$router->get('/registration', 'user/create.php')->only('guest');
$router->post('/registration', 'user/store.php')->only('guest');

// Logout
$router->delete('/session/destroy', 'session/destroy.php')->only('auth');

// Admin panel
$router->get('/admin', 'admin.php')->only('auth', 'admin');

// DYNAMIC
// Post (public)
$router->get('/post/{id}', 'post/show.php');
// Profile (public)
$router->get('/{login}', 'user/show.php');
// $router->get('/{login}/edit', 'user/edit.php');
// $router->post('/{login}/edit', 'user/update.php')->only('auth');
// $router->patch('/{login}/edit', 'user/update.php');