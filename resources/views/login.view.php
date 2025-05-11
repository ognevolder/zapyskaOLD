<?php

use Core\Render;

// Fetch errors from $session
$errors = $session->getFlashMessage('errors');
// Fetch old data from $session
$old = $session->getFlashMessage('old');

Render::components([
  'head-open',
  ['login' => ['errors' => $errors, 'old' => $old]],
  'head-close'
]);