<?php

use Core\Render;

Render::components([
  'head-open',
  ['post' => ['post' => $post, 'author' => $author]],
  'head-close'
]);