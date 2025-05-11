<?php

use Core\App;
use Core\Csrf;
use Core\Forms\RegisterForm;
use Core\Response;
use Core\Session;

// Fetch Session singleton
$session = App::getContainer()->resolve(Session::class);
// CSRF-token check
$csrfToken = $_POST['_csrf_token'] ?? null;
if (!isset($csrfToken) || !Csrf::validateToken($csrfToken))
{
  Response::send(403);
  exit();
}

// Data validation
$user_name = $_POST['user_name'] ?? null;
$user_password = $_POST['user_password'] ?? null;
$user_login = $_POST['user_login'] ?? null;
$form = RegisterForm::validate(['user_name' => $user_name, 'user_password' => $user_password, 'user_login' => $user_login]);



