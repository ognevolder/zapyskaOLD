<?php

namespace Core;


class Router
{
  protected $routes = [];

  /**
   * Register a new route with $uri, $method and corresponding $controller
   *
   * @param string $uri
   * @param string $method
   * @param string $controller
   * @return void
   */
  public function add(string $uri, string $method, string $controller)
  {
      $this->routes[] = [
        'uri' => $uri,
        'method' => $method,
        'controller' => $controller
      ];

      return $this;
  }

  // Register a GET request
  public function get(string $uri, string $controller)
  {
    $this->add($uri, 'GET', $controller);
  }

  // Register a POST request
  public function post(string $uri, string $controller)
  {
    $this->add($uri, 'POST', $controller);
  }

  // Register a PATCH request
  public function patch(string $uri, string $controller)
  {
    $this->add($uri, 'PATCH', $controller);
  }

  // Register a DELETE request
  public function delete(string $uri, string $controller)
  {
    $this->add($uri, 'DELETE', $controller);
  }

  public function route(string $uri, string $method)
  {
    foreach ($this->routes as $route)
    {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method))
      {
        require BASE_PATH . "App/http/controllers/{$route['controller']}";
        return;
      }
    }
    $this->abort();
  }

  protected function abort($code = 404)
  {
    Response::send($code);
  }

  public function redirect(string $path): void
  {
    header('Location: ' . $path, true, 302);
  }
}