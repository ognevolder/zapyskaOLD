<?php

namespace App\models;

use Core\Database;
use PDO;
use Faker\Factory as FakerFactory;

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

  /**
   * Creating a random post for DB
   * 
   * @return void
   */
  public function seedRandomPosts(int $count = 1): void
  {
    $faker = FakerFactory::create('uk_UA');

    $sql = "INSERT INTO posts (title, body, tag, author_id) VALUES (:title, :body, :tag, :author_id)";
    $stmt = $this->pdo->prepare($sql);

    for ($i = 0; $i < $count; $i++)
    {
      $stmt->execute([
        ':title' => $faker->sentence(mt_rand(4, 8)),
        ':body' => $faker->paragraphs(mt_rand(2, 5), true),
        ':tag' => $faker->word(),
        ':author_id' => rand(1, 2)
      ]);
    }
  }
}