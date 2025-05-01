<?php

namespace Core;

class Loger
{
  public static function write(string $message): void
  {
    $logFile = __DIR__ . '/logs.log';
    error_log("[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL, 3, $logFile);
  }
}