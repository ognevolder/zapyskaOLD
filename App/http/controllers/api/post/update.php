<?php

use Core\App;
use Core\Database;

return function ($id)
{
  header('Content-Type: application/json');
  $db = App::getContainer()->resolve(Database::class);
  $data = json_decode(file_get_contents("php://input"), true);

  $title = $data['title'] ?? null;
  $body = $data['body'] ?? null;

  $db->query("UPDATE api SET title = :title, body = :body WHERE id = :id", [
    'title' => $title,
    'body' => $body,
    'id' => $id
  ]);

  echo json_encode([
    'message' => 'Updated!',
    'post' => [
      'title' => $title,
      'body' => $body,
      'id' => $id
    ]
  ]);
};