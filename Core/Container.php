<?php

namespace Core;

use Exception;
use ReflectionClass;

class Container
{
  protected array $bindings = [];
  protected array $singletons = [];
  protected array $instances = [];

  public function bind(string $key, callable $resolver)
  {
    $this->bindings[$key] = $resolver;
  }

  public function singletone(string $key, callable $resolver)
  {
    $this->singletons[$key] = $resolver;
  }

  public function resolve(string $key)
  {
    // If singletone already exist - return it
    if (isset($this->instances[$key]))
    {
      return $this->instances[$key];
    }

    // If singletone is registered but not exist - create it
    if (isset($this->singletons[$key]))
    {
      $this->instances[$key] = call_user_func($this->singletons[$key], $this);
      return $this->instances[$key];
    }

    // If only bind
    if (isset($this->bindings[$key])) 
    {
      return call_user_func($this->bindings[$key], $this);
    }

    // Attempt to creating a class
    if (class_exists($key))
    {
      return $this->build($key);
    }

    throw new Exception("Service [{$key}]  is not registered in the container.");
  }

  protected function build(string $className)
  {
    $reflector = new ReflectionClass($className);

    // If class does not have a constructor - build it
    if (!$reflector->getConstructor())
    {
      return new $className;
    }

    $constructor = $reflector->getConstructor();
    $parameters = $constructor->getParameters();
    $dependencies = [];

    foreach ($parameters as $param)
    {
      $type = $param->getType();

      if ($type === null || $type->isBuiltin())
      {
        throw new Exception("Cannot resolve class dependency [{$param->name}] in class [{$className}].");
      }
      $dependencies[] = $this->resolve($type->getName());
    }
    return $reflector->newInstanceArgs($dependencies);
  }
}