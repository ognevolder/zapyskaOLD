<?php

use Core\Render;

// Fetch errors from $session
$errors = $session->getFlashMessage('errors');

Render::components([
  'head-open',
  ['name-edit' => ['user' => $user, 'errors' => $errors]],
  'head-close'
]);