<?php

use Core\App;
use Core\Container;
use Core\Router;
use Core\Session;

const BASE_PATH = __DIR__.'/../';
require BASE_PATH . 'vendor/autoload.php';

App::requestAll([
  'App/bootstrap.php',
  'seeder.php'
]);

// Session
$session = App::getContainer()->resolve(Session::class);
// Router
$router = App::getContainer()->resolve(Router::class);

// Clear flash-messages
$session->clearFlashMessage();




