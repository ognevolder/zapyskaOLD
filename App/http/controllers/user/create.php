<?php

use Core\App;
use Core\Render;
use Core\Session;

// Fetch Session singleton
$session = App::getContainer()->resolve(Session::class);

// Test
App::inspect($session);

// Render view with Session
Render::view('registration', ['session' => $session]);