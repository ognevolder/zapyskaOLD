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

  public static function inspect($data)
  {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
  }

  public static function getAuthorForPost(array $post, array $authors)
  {
    return $authors[$post['author_id']] ?? null;
  }
}