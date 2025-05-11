<?php

use Core\App;
use Core\Render;
use Core\Session;

// Fetch Session singleton
$session = App::getContainer()->resolve(Session::class);

Render::view('login', [
  'session' => $session
]);

