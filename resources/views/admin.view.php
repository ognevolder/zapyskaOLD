<?php

use Core\Render;

Render::components([
  'head-open',
  ['admin' => ['allAuthors' => $allAuthors]],
  'head-close'
]);