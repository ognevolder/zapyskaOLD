<?php

use Core\App;
use Core\Router;

$login = Router::param('login');

App::inspect($login);
