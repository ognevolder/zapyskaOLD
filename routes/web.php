<?php

// Home page
$this->get('/', 'home.php');

// Login
$this->get('/login', 'session/create.php');
$this->post('/login', 'session/store.php');

// Profile
$this->get('/profile', 'profile.php');

// Registration
$this->get('/registration', 'user/create.php');
$this->post('/registration', 'user/store.php');