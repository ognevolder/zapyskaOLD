<?php

use Core\App;
use Core\Database;
use Core\Router;

Router::require('App/database/db-bootstrap.php');

Router::component('head-open.php');

Router::component('navbar.php');
Router::component('hero.php');
Router::component('divider.php');
Router::component('post-grid.php');
$db = App::useContainer()->resolve(Database::class);

Router::component('head-close.php');