<?php

use Core\App;
use Core\Container;
use Core\Database;

$config = require BASE_PATH . 'config/db.php';
$container = new Container();

// DB
$container->singletone(Database::class, function($c) use ($config)
{
  return new Database($config);
});

App::setContainer($container);
