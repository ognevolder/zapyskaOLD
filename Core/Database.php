<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
  protected $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES => false
  ];

  public function __construct(array $config)
  {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    try
    {
      new PDO($dsn, $config['user'], $config['password'], $this->options);
    } catch (PDOException $e)
    {
      echo "Database connection failed: {$e->getMessage()}.";
    }
  }
}