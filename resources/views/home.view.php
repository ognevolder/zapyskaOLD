<?php

use Core\Router;

Router::require('App/database/db-bootstrap.php');

Router::component('head-open.php');

Router::component('navbar.php');
Router::component('hero.php');
Router::component('divider.php');
Router::component('post-grid.php', ['data' => $data]);

Router::component('head-close.php');