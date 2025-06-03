<?php

use App\models\AuthorRepository;
use Core\App;
use Core\Database;
use Core\Render;
use Core\Router;

// DB Singletone
$db = App::getContainer()->resolve(Database::class);

// Post data
$post = $db->query("SELECT * FROM posts WHERE id = :id", ['id' => Router::param('id')])->fetch();
// Author data
$authorRepo = App::getContainer()->resolve(AuthorRepository::class);
$authors = $authorRepo->getAllAuthorsById();
$author = $authorRepo->getAuthorOfPost($post, $authors);

// Render view
Render::view('post/show', ['post' => $post, 'author' => $author]);
