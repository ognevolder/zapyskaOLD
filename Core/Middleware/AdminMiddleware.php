<?php

namespace Core\Middleware;

use Core\Response;
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
        $user = $this->session->getValue('user');
        if (!isset($user['admin']) || (int)$user['admin'] !== 1)
        {
            Response::send(403);
            exit();
        }
    }
}