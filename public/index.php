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

$session = new Session;

$router = new Router;
require BASE_PATH . 'routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try
{
  $router->route($uri, $method);
}
catch (ValidatorException $exception)
{
  $session->setFlashMessage($exception->errors, 'errors');
  $session->setOldData($exception->old, 'old');
  $router->redirect($_SERVER['HTTP_REFERER']);
}



