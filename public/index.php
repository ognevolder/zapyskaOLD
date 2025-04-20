<?php

use Core\Router;

const BASE_PATH = __DIR__.'/../';

require "../vendor/autoload.php";

$router = new \Core\Router();
$routes = require "../routes/web.php";
 
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
 
$router->route($uri, $method);
