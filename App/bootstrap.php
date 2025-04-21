<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Router;

$config = Router::require('config/db.php');
$container = new Container();

// DB
$container->singletone(Database::class, function($c) use ($config)
{
  return new Database($config);
});

App::setContainer($container);
