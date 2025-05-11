<?php

use Core\Render;

Render::components([
  'head-open',
  ['registration' => ['session' => $session]],
  'head-close'
]);