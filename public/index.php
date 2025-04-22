<?php

use Core\Router;

const BASE_PATH = __DIR__.'/../';

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'App/bootstrap.php';

$router = new Router();
require BASE_PATH . 'routes/web.php';
 
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
 
$router->route($uri, $method);
