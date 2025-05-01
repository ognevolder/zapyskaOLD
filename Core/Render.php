<?php

namespace Core;

use Exception;

class Render 
{
  /**
   * Secure the file path and validate that it belongs to the allowed base directory.
   *
   * @param string $path
   * @param string $baseDir
   * @return string
   */
  protected static function securePath(string $path, string $baseDir): string
  {
      // Видаляємо небезпечні символи
      $path = str_replace(['../', './', '..\\', '.\\'], '', $path);
      $fileName = basename($path);
  
      // Формуємо повний шлях
      $fullPath = rtrim($baseDir, '/') . '/' . $fileName;
  
      // Отримуємо реальний фізичний шлях
      $realPath = realpath($fullPath);
  
      // Перевіряємо, чи файл дійсно знаходиться всередині дозволеної папки
      if ($realPath === false || strpos($realPath, realpath($baseDir)) !== 0) {
          throw new Exception("Access denied to file [{$path}].");
      }
  
      return $realPath;
  }

  /**
  * Нормалізує ім’я файлу та додає відповідне розширення.
  */
  protected static function normalizeFileName(string $name, string $extension): string
  {
    $safeName = basename($name); // Видаляє шляхи
    $cleanName = preg_replace('/(\.php|\.template\.php|\.view\.php)$/', '', $safeName);
    return $cleanName . $extension;
  }

  protected static function handleRender(string $fileName, string $baseDir, array $data = []): void
  {
    try 
    {
      $fullPath = self::securePath($fileName, $baseDir);
      extract($data);
  
      if (!file_exists($fullPath)) 
      {
        throw new Exception("File [{$fullPath}] does not exist.");
      }
        require $fullPath;
    }
    catch (Exception $e) 
    {
        echo "Render error: ", $e->getMessage();
        exit();
    }
  }

  /**
   * Render VIEW with corresponding $name from views folder and get an array $data with additional data
   *
   * @param string $name
   * @param array $data
   * @return void
   */
  public static function view(string $name, array $data = []): void
  {
    $fileName = self::normalizeFileName($name, '.view.php');
    self::handleRender($fileName, BASE_PATH . "resources/views/", $data);
  }

  /**
   * Render COMPONENT with corresponding $name from components folder and get an array $data with additional data
   *
   * @param string $name
   * @param array $data
   * @return void
   */
  public static function component(string $name, array $data = []): void
  {
    $fileName = self::normalizeFileName($name, '.template.php');
    self::handleRender($fileName, BASE_PATH . "resources/views/components/", $data);
  }
  
  /**
   * Render multiple components from $list
   *
   * @param array $list
   * @return void
   */
  public static function components(array $list): void
  {
    foreach ($list as $entry)
    {
      if (is_string($entry))
      {
        self::component($entry);
      }
      elseif (is_array($entry))
      {
        foreach ($entry as $file => $data)
        {
          self::component($file, $data);
        }
      }
    }
  } 
}