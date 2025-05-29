<?php

use Core\Render;
use Core\Session;

// User-data from Session
$user = Session::getValue('user');

// Render view with User-data
Render::view('user/index', ['user' => $user]);