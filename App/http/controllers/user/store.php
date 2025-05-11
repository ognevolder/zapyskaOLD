<?php

use Core\App;
use Core\Csrf;
use Core\Forms\RegisterForm;
use Core\Render;
use Core\Response;
use Core\Router;
use Core\Session;
use Core\ValidatorException;

// CSRF-token check
$csrfToken = $_POST['_csrf_token'] ?? null;
if (!isset($csrfToken) || !Csrf::validateToken($csrfToken))
{
  Response::send(403);
  exit();
}
// Fetch Session singleton
$session = App::getContainer()->resolve(Session::class);

// Creating a Register Form instanse
$user_name = $_POST['user_name'] ?? null;
$user_password = $_POST['user_password'] ?? null;
$user_login = $_POST['user_login'] ?? null;
$form = new RegisterForm([
  'user_name' => $user_name,
  'user_password' => $user_password,
  'user_login' => $user_login
]);
// Data validation
try
{
  $form->validate([
    'user_name' => $user_name,
    'user_password' => $user_password,
    'user_login' => $user_login
  ]);
}
catch (ValidatorException $e)
{
  $session->setFlashMessage($e->errors, 'errors');
  $session->setFlashMessage($e->old, 'old');
}

// Redirect
Router::redirect('/');




