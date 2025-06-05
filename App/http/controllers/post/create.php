<?php

use Core\App;
use Core\Render;
use Core\Session;

$session = App::getContainer()->resolve(Session::class);

Render::view('post/create', ['session' => $session]);