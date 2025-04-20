<?php

use Core\App;
use Core\Database;
use Core\Router;

// Initiate a DB
$db = App::useContainer()->resolve(Database::class);
// Prepare the query and fetch the data
$data = $db->query("SELECT * FROM posts")->fetchAll();

Router::view('home', ['data' => $data]);