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
    $sql = "SELECT * FROM posts";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
  /**
   * Count posts
   * 
   * @return int
   */
  public function count(): int
  {
    return $this->pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
  }

  /**
   * Post pagination
   * 
   * @return array
   */
  public function paginate(int $limit, int $offset): array
  {
    $sql = "SELECT * FROM posts ORDER BY date DESC LIMIT :limit OFFSET :offset";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }
}