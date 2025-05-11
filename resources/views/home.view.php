<?php

use Core\Render;

$user = $session::getValue('user');

Render::components([
  'head-open',
  ['navbar' => ['user' => $user]],
  'hero',
  'divider',
  ['post-grid' => ['posts' => $posts, 'authors' => $authors]],
  'divider',
  ['pagination' => ['paginator' => $paginator]],
  'footer',
  'head-close'
]);