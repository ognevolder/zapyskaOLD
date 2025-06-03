<?php

use App\models\AuthorRepository;
use Core\App;
use Core\Database;
use Core\Render;

// Fetch DB singletone
$db = App::getContainer()->resolve(Database::class);

// Create Author repo
$day = 1;
$week = 7;
$month = 30;

$authorsRepo = new AuthorRepository($db);
$allAuthors = $authorsRepo->countAll();
$dayAuthors = $authorsRepo->count($day);
$weekAuthors = $authorsRepo->count($week);
App::inspect($dayAuthors);
App::inspect($weekAuthors);


Render::view('admin', [
  'allAuthors' => $allAuthors
]);