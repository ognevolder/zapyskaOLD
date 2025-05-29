<?php

use Core\App;
use Core\Csrf;
use Core\Forms\UpdateForm;
use Core\Response;
use Core\Router;

// CSRF-token check
$csrfToken = $_POST['_csrf_token'] ?? null;
if (!isset($csrfToken) || !Csrf::validateToken($csrfToken))
{
  Response::send(403);
  exit();
}

// Array of attributes
$attributes = [
  'user_name' => $_POST['user_name'] ?? '',
  'user_password' => $_POST['user_password'] ?? '',
  'user_login' => $_POST['user_login'] ?? ''
];

// Creating a Update-Form instanse
$form = new UpdateForm($attributes);

// Validate
$form->validationCheck();
// PATCH in db
$form->update();
// Login
$form->login();
// Redirect
Router::redirect('/');
App::inspect($_POST);