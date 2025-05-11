<?php

namespace Core\Middleware;

use Core\Session;

class AdminMiddleware implements Middleware
{
    protected Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function handle(): void
    {
        $user = $this->session::getValue('user');
        if (!$user || $user['role'] !== 'admin') {
            header('HTTP/1.1 403 Forbidden');
            exit('Access denied');
        }
    }
}