<?php

namespace App\models;

use Core\Database;
use PDO;

class AuthorRepository
{
  protected PDO $pdo;

  public function __construct(Database $db)
  {
    $this->pdo = $db->getConnection();
  }

  /**
   * Fetch all users, binded to theirs id
   * 
   * @return array
   */
  public function getAllAuthorsById(): array
  {
    $sql = "SELECT * FROM authors";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    $authors = $stmt->fetchAll();
    return array_column($authors, null, 'id');
  }

  public static function getAuthorOfPost(array $post, array $authors)
  {
    return $authors[$post['author_id']] ?? null;
  }
  
}