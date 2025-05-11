<?php

namespace Core\Middleware;

interface Middleware {
  public function handle(): void;
}