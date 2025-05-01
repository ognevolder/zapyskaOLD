<?php

namespace Core;

use Exception;

class Response
{
  /**
   * HTTP response with corresponding $code
   *
   * @param int $code
   * @return void
   */
  public static function send(int $code): void
  {
    if (headers_sent()) {
      // Вже пізно змінювати заголовки, покажи стандартну помилку
      echo "<h1>Error {$code}</h1><p>Headers already sent. Cannot change response code.</p>";
      exit();
    }
    
    http_response_code($code = 404);
    $fullPath = BASE_PATH . "resources/views/response/{$code}.php";

    try
    {
      if (!file_exists($fullPath))
      {
        echo "<h1>Error {$code}</h1><p>Page is not found</p>";
        exit();
      }
      require $fullPath;
    }
    catch (Exception $e)
    {
      echo "Response error: ", $e->getMessage();
      exit();
    }
  }
}