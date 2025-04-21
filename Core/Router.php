<?php

namespace Core;

use Exception;

class Router
{
  protected $routes = [];

  public static function require(string $path)
  {
    return require BASE_PATH . $path;
  }

  public static function component(string $name, array $data = [])
  {
    $path = "../resources/components/{$name}";
    extract($data);

    try
    {
      if (!file_exists($path)) {
        throw new Exception("Component [{$name}] does not exist.");
      }
      return require $path;
    } catch (Exception $e) 
    {
      echo "Route error: ", $e->getMessage();
      exit();
    }
  }

  public static function view(string $path, array $data = [])
  {
    $path = "../resources/views/{$path}.view.php";
    extract($data);

    try
    {
      if (!file_exists($path)) {
        throw new Exception("View [{$path}] does not exist.");
      }
      return require $path;
    } catch (Exception $e)
    {
      echo "Route error: ", $e->getMessage();
      exit();
    }
  }

  public static function response(string $code)
  {
    $path = "../resources/response/{$code}.php";

    try
    {
      if (!file_exists($path)) {
        throw new Exception("File [{$path}] does not exist.");
      }
      return require $path;
    } catch (Exception $e)
    {
      echo "Route error: ", $e->getMessage();
      exit();
    }
  }

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
        return require("../App/http/controllers/{$route['controller']}");
      }
    }
    $this->abort();
  }

  protected function abort($code = 404)
  {
    http_response_code($code);
    static::response("{$code}");
    die();
  }
}