<?php

use App\models\AuthorRepository;
use App\models\PostRepository;
use Core\App;
use Core\Paginator;
use Core\Render;

// Connect to service container
$container = App::getContainer();

// Create DB instance and resolve Repositories
$authorRepo = $container->resolve(AuthorRepository::class);
$postRepo = $container->resolve(PostRepository::class);

// Get URL
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Pagination
$perPage = 6;
$totalPosts = $postRepo->count();

$paginator = new Paginator($page, $perPage, $totalPosts);

// Fetch data from DB
$posts = $postRepo->paginate($paginator->perPage, $paginator->offset());
$authors = $authorRepo->getAllAuthorsById();

Render::view('home', [
  'posts' => $posts,
  'authors' => $authors,
  'paginator' => $paginator
]);