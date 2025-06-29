<?php

use Core\App;
use Core\Database;

// Header
header('Content-Type: application/json');
// DB Singletone
$db = App::getContainer()->resolve(Database::class);

// Data
$posts = $db->query("SELECT * FROM posts ORDER BY date DESC")->fetchAll();

echo json_encode($posts);
