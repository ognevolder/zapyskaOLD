<?php

use Core\Csrf;
use Core\Forms\RegisterForm;
use Core\Response;
use Core\Router;

// CSRF-token check
$csrfToken = $_POST['_csrf_token'] ?? null;
if (!isset($csrfToken) || !Csrf::validateToken($csrfToken))
{
  Response::send(403);
  exit();
}

// Creating a Register Form instanse
$form = new RegisterForm([
  'user_name' => $_POST['user_name'] ?? null,
  'user_password' => $_POST['user_password'] ?? null,
  'user_login' => $_POST['user_login'] ?? null
]);

// Data validation
$form->validationCheck();

// Data injection
$form->inject();

// Login and create Session
$form->login();

// Redirect
Router::redirect('/');




