<?php

use App\models\PostRepository;
use App\models\UserRepository;
use Core\App;
use Core\Router;

// Connect to service container
$container = App::getContainer();

// Create DB instance and resolve Repositories
$authorRepo = $container->resolve(UserRepository::class);
$postRepo = $container->resolve(PostRepository::class);

// Fetch data from DB
$posts = $postRepo->all();
$authors = $authorRepo->getAllUsersById();

Router::view('home', ['posts' => $posts, 'authors' => $authors]);