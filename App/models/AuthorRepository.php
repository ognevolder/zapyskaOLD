<?php

namespace App\models;

use Core\Database;
use PDO;
use Faker\Factory as FakerFactory;

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

  /**
   * Returns a
   *
   * @param array $post
   * @param array $authors
   */
  public static function getAuthorOfPost(array $post, array $authors)
  {
    return $authors[$post['author_id']] ?? null;
  }

  /**
   * Fetch author with $login
   *
   * @param string $login
   * @return array
   */
  public function fetchByLogin($login)
  {
    $sql = "SELECT * FROM authors WHERE login_name = :login";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['login' => $login]);

    return $stmt->fetch();
  }


  /**
   * Creating a random post for DB
   *
   * @return void
   */
  public function seedRandomAuthors(int $count = 1): void
  {
    $faker = FakerFactory::create('uk_UA');

    $sql = "INSERT INTO authors (name, role, password, login_name, admin) VALUES (:name, :role, :password, :login_name, :admin)";
    $stmt = $this->pdo->prepare($sql);

    for ($i = 0; $i < $count; $i++)
    {
      $stmt->execute([
        ':name' => $faker->name(),
        ':role' => $faker->jobTitle(),
        ':password' => password_hash('123456', PASSWORD_BCRYPT),
        ':login_name' => $faker->word(),
        ':admin' => rand(0, 1)
      ]);
    }
  }
}