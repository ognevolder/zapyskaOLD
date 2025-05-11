<?php

namespace Core;


class Router
{
  protected $routes = [];
  protected Session $session;
  protected Response $response;
  protected array $middlewares = [];
  protected ?string $uri;
  protected ?string $method;

  /**
   * Initiate a Router body and require a routes
   */
  public function __construct(Session $session, Response $response)
  {
    $this->session = $session;
    $this->response = $response;

    // Автоматичне зчитування URI та HTTP-методу
    $this->uri = parse_url($_SERVER['REQUEST_URI'])['path'] ?? '/';
    $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

    // Підключення маршрутів
    require BASE_PATH . 'routes/web.php';

    // Автоматичний запуск маршрутизації
    try {
        $this->route($this->uri, $this->method);
    } catch (ValidatorException $e) {
        $this->session->setFlashMessage($e->errors, 'errors');
        $this->session->setOldData($e->old, 'old');
        $this->redirectBack();
    }
  }

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

  public function route()
  {
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

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
    exit();
  }

  // Redirect to a previous page
  public function redirectBack(): void
  {
    $referer = $_SERVER['HTTP_REFERER'] ?? '/';
    $this->redirect($referer);
  }
}