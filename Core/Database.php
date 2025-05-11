<?php

namespace Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
  protected $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  ];
  protected PDO $connection;
  protected PDOStatement $statement;

  public function __construct(array $config)
  {
    $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";
    try
    {
      $this->connection = new PDO($dsn, $config['user'], $config['password'], $this->options);

    } catch (PDOException $e)
    {
      echo "Database connection failed: {$e->getMessage()}.";
    }
  }

  public function getConnection(): PDO
  {
    return $this->connection;
  }

  public function query(string $query, array $params = [])
  {
    $this->statement = $this->connection->prepare($query);
    $this->statement->execute($params);
    return $this->statement;
  }


}