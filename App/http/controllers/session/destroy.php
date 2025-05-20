<?php

use Core\Router;
use Core\Session;

Session::destroy();
Router::redirect('/');