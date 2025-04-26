<?php

namespace Core;

use Exception;

class Router
{
  protected $routes = [];

  public static function component(string $file, array $data = []): void
  {
    if (!str_ends_with($file, 'template.php'))
    {
      $file .= '.template.php';
    }
    $path = BASE_PATH . "resources/views/components/{$file}";
    extract($data);

    try {
      if (!file_exists($path)) {
          throw new Exception("Component [{$path}] does not exist.");
      }
      require $path;
    } catch (Exception $e) {
      echo "Component error: ", $e->getMessage();
      exit();
    }
  }

  public static function components(array $list): void
  {
    foreach ($list as $entry) 
    {
      if (is_string($entry)) 
      {
        self::component($entry); // без даних
      } 
      elseif (is_array($entry)) 
      {
        // ['file.php' => ['posts' => $posts]]
        foreach ($entry as $file => $data) 
        {
          self::component($file, $data);
        }
      }
    }
  }

  public static function view(string $path, array $data = [])
  {
    if (!str_ends_with($path, '.php'))
    {
      $path .= '.view.php';
    }
    $fullPath = BASE_PATH . "resources/views/{$path}";
    extract($data);

    try
    {
      if (!file_exists($fullPath)) {
        throw new Exception("View [{$fullPath}] does not exist.");
      }
      return require $fullPath;
    } catch (Exception $e)
    {
      echo "Route error: ", $e->getMessage();
      exit();
    }
  }

  public static function response(string $code)
  {
    $path = BASE_PATH . "resources/response/{$code}.php";

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
    foreach ($this->routes as $route) {
      
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) 
      {
        return require BASE_PATH . "App/http/controllers/{$route['controller']}";
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