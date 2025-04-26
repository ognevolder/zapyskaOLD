<?php

use Core\Router;

Router::components([
  'head-open',
  'navbar',
  'hero',
  'divider',
  ['post-grid' => ['posts' => $posts, 'authors' => $authors]],
  'divider',
  ['pagination' => ['paginator' => $paginator]],
  'footer',
  'head-close'
]);