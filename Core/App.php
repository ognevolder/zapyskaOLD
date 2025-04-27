<?php

namespace Core;

class App 
{
  protected static $container;

  public static function setContainer(object $container)
  {
    static::$container = $container;
  }

  public static function getContainer(): object
  {
    return static::$container;
  }

  public static function inspectIsolate($data)
  {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
  }

  public static function inspect($data)
  {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
  }
  
  // Require an array of $files
  public static function requestAll(array $files = [])
  {
    foreach ($files as $file)
    {
      require BASE_PATH . $file;
    }
  }

  // Require a single file
  public static function request(string $file)
  {
    require BASE_PATH . $file;
  }
}