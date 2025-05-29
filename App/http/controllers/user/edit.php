<?php

use Core\App;
use Core\Database;
use Core\Render;
use Core\Session;

// DB singletone
$db = App::getContainer()->resolve(Database::class);

// Session singleton
$session = App::getContainer()->resolve(Session::class);

// Fetch user data
if (Session::getValue('user', 'id'))
{
  $user = $db->query('SELECT * FROM authors WHERE id = :id', ['id' => Session::getValue('user', 'id')])->fetch();
  Render::view('user/edit', [
  'user' => $user,
  'session' => $session
]);
}

