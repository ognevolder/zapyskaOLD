<?php

namespace Core\Middleware;

use Core\Router;
use Core\Session;

class AuthMiddleware implements Middleware
{
    protected Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function handle(): void
    {
        if (!$this->session::getValue('user')) {
            Router::redirect('/login');
        }
    }
}