<?php

use Core\App;
use Core\Csrf;
use Core\Database;
use Core\Forms\LoginForm;
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

// Fetch DB singleton
$db = App::getContainer()->resolve(Database::class);

// Create Login form instance
$login = $_POST['user_login'];
$password = $_POST['user_password'];

$form = new LoginForm([
  'user_login' => $login ?? null,
  'user_password' => $password ?? null
]);

// Validate POST
try
{
  $form->validate();
}
catch (ValidatorException $e)
{
  $session->setFlashMessage($e->errors, 'errors');
  $session->setFlashMessage($e->old, 'old');
  Router::redirectBack();
}

// Check DB credentials
$user = $db->query("SELECT * FROM authors WHERE login_name = :login", [
  'login' => $login
])->fetch();

if (!$user || !password_verify($password, $user['password'])) {
  // Невірний логін або пароль
  throw new ValidatorException(
      ['login' => 'Невірне імʼя користувача або пароль'],
      ['login_name' => $login]
  );
} else {
  $session::setValue('user', $user);
  Router::redirect('/');
}


