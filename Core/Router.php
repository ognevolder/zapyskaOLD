<?php

namespace Core;

use Core\Middleware\AdminMiddleware;
use Core\Middleware\AuthMiddleware;
use Core\Middleware\GuestMiddleware;

class Router
{
  protected $routes = [];
  protected Session $session;
  protected Response $response;
  protected array $middlewares = [];
  protected ?string $uri;
  protected ?string $method;
  protected array $params = [];

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
  }

  public function loadRoutes(): void
  {
    $router = $this;
    require BASE_PATH . 'routes/web.php';
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
        'controller' => $controller,
        'middleware' => []
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
    foreach ($this->routes as $route) {
        $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', $route['uri']);
        $pattern = "#^" . $pattern . "$#";

        if (preg_match($pattern, $this->uri, $matches) && $route['method'] === $this->method) {
            array_shift($matches); // Видаляємо повний збіг

            // Зберігаємо параметри
            preg_match_all('#\{([^}]+)\}#', $route['uri'], $paramNames);
            $this->params = array_combine($paramNames[1], $matches);

            // Middleware
            foreach ($route['middleware'] as $mw) {
                $this->resolveMiddleware($mw);
            }

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

  protected function resolveMiddleware(string $middleware)
  {
    $middlewareClass = match ($middleware) {
        'auth' => AuthMiddleware::class,
        'guest' => GuestMiddleware::class,
        'admin' => AdminMiddleware::class,
        default => throw new \Exception("Middleware '{$middleware}' not found.")
    };

    (new $middlewareClass)->handle();
  }

  public function middleware(array $middlewares)
  {
    $lastKey = array_key_last($this->routes);
    $this->routes[$lastKey]['middleware'] = $middlewares;

    return $this;
  }

  public function only(string $middleware)
  {
    return $this->middleware([$middleware]);
  }

  public static function redirect(string $path): void
  {
    header('Location: ' . $path, true, 302);
    exit();
  }

  // Redirect to a previous page
  public static function redirectBack(): void
  {
    $referer = $_SERVER['HTTP_REFERER'] ?? '/';
    static::redirect($referer);
  }

  public static function param(string $key): ?string
  {
    return App::getContainer()->resolve(Router::class)->params[$key] ?? null;
  }

  public static function params(): array
  {
    return App::getContainer()->resolve(Router::class)->params;
  }
}