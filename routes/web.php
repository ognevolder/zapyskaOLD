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

// Post create
$router->get('/post/create', 'post/create.php')->only('auth');
$router->post('/post/create', 'post/store.php')->only('auth');
$router->post('/post/draft', 'post/draft.php')->only('auth');

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

// API
$router->get('/api/posts', 'api/post/index.php');
$router->post('/api/posts', 'api/post/store.php');
$router->patch('/api/posts/{id}', 'api/post/update.php');