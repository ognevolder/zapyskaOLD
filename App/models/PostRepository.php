<?php

namespace App\models;

use Core\Database;
use PDO;

class PostRepository
{
  protected PDO $pdo;

  public function __construct(Database $db)
  {
    $this->pdo = $db->getConnection();
  }

  /**
   * Fetch all posts
   * 
   * @return array
   */
  public function all(): array
  {
    $sql = "SELECT * FROM posts ORDER BY date DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
}