<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Router;

$container = new Container;

$container->bind('Core\Database', function()
{
  $config = Router::require('./config/db.php');
  return new Database($config);
});

App::setContainer($container);
