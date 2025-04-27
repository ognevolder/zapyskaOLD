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
}