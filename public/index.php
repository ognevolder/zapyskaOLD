<?php

use Core\App;
use Core\Router;
use Core\Session;
use Core\ValidatorException;

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
$router->loadRoutes();

try {
    $router->route();
} catch (ValidatorException $e) {
    $session->setFlashMessage($e->errors, 'errors');
    $session->setOldData($e->old, 'old');
    $router->redirectBack();
}

// Clear flash-messages
$session->clearFlashMessage();




