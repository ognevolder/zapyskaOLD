<?php

use Core\App;
use Core\Database;
use Core\Forms\PostCreate;
use Core\Router;
use Core\Session;

App::inspect($_POST);
// Create Session singletone
$session = App::getContainer()->resolve(Database::class);

// Fetch Author instance from Session
$author = Session::getValue('user') ?? null;

// Check author
if (isset($author))
{
  // Validation
  $form = new PostCreate([
    'title' => $_POST['post-title'],
    'body' => $_POST['post-body'],
    'tag' => $_POST['post-tag'],
    'privacy' => $_POST['privacy'] ?? 'off'
  ]);

  $form->validationCheck();

  // Store to DB

  // Redirect to Profile-page
} else
{
  Router::redirectBack();
}

