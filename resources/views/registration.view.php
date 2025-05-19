<?php

use Core\Render;

// Fetch errors from $session
$errors = $session->getFlashMessage('errors');
// Fetch old data from $session
$old = $session->getFlashMessage('old');
// Fetch database errors from $session
$dbErrors = $session->getFlashMessage('db');

Render::components([
  'head-open',
  ['registration' => ['errors'=> $errors, 'old' => $old, 'db' => $dbErrors]],
  'head-close'
]);