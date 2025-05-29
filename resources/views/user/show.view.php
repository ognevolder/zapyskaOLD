<?php

use Core\Render;

Render::components([
  'head-open',
  ['profile' => ['user' => $user]],
  'head-close'
]);