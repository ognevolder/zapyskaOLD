<?php

namespace Core;

class Loger
{
  public static function write(string $message): void
  {
    $logFile = BASE_PATH . '/logs.log';
    error_log("[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL, 3, $logFile);
  }
}