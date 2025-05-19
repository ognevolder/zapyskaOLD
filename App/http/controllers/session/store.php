<?php

use Core\Csrf;
use Core\Forms\LoginForm;
use Core\Response;
use Core\Router;

// CSRF-token check
$csrfToken = $_POST['_csrf_token'] ?? null;
if (!isset($csrfToken) || !Csrf::validateToken($csrfToken))
{
  Response::send(403);
  exit();
}

// Create Login form instance
$form = new LoginForm([
  'user_login' => $_POST['user_login'] ?? null,
  'user_password' => $_POST['user_password'] ?? null
]);

// Validate
$form->validationCheck();

// Check DB credentials
$form->authorise();

// Login
$form->login();

// Redirect
Router::redirect('/');


