<?php

use Core\App;
use Core\Router;

$id = Router::param('id'); // /posts/{id}

App::inspect($id);
