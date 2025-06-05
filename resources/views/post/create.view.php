<?php

use Core\Render;

// Fetch errors from $session
$errors = $session->getFlashMessage('errors');

Render::components([
  'head-open',
  ['post-create' => ['errors' => $errors]],
  'head-close'
]);