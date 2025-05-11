<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Response;
use Core\Router;
use Core\Session;

$config = require BASE_PATH . 'config/db.php';
$container = new Container();

// DB
$container->singletone(Database::class, function($c) use ($config)
{
  return new Database($config);
});

// Session
$container->singletone(Session::class, fn() => new Session);
// Response
$container->singletone(Response::class, fn() => new Response);
// Router
$container->singletone(Router::class, fn($c) => new Router(
  $c->resolve(Session::class),
  $c->resolve(Response::class)
));

App::setContainer($container);
