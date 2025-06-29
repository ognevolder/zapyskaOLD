<?php

use Core\App;
use Core\Database;

header('Content-Type: Application/json');

$data = json_decode(file_get_contents("php://input"), true);

$title = trim($data['title']);
$body = trim($data['body']);

$db = App::getContainer()->resolve(Database::class);

$db->query("INSERT INTO api (title, body) VALUES (:title, :body)", [
  'title' => $title,
  'body' => $body
]);

http_response_code(201);
echo json_encode([
  'message' => 'Post created',
  'post' => [
    'title' => $title,
    'body' => $body
  ]
  ]);
