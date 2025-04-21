<?php

use Core\Router;

Router::component('head-open.php');

Router::component('navbar.php');
Router::component('hero.php');
Router::component('divider.php');
Router::component('post-grid.php', ['posts' => $posts, 'authors' => $authors]);
Router::component('divider.php');

Router::component('head-close.php');