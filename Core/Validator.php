<?php

namespace Core;

use Core\Database;
use Core\App;

class Validator
{
  /**
   * Implements require-logic to posted $field
   *
   * @param string $field
   * @return bool
   */
  public static function required(string $field): bool
  {
    return (!empty(trim($field)));
  }

  /**
   * Check text length and compare to $min and $max
   *
   * @param string $field
   * @param int $min
   * @param int $max
   * @return boolean
   */
  public static function password(string $field, int $min = 6, int $max = INF): bool
  {
    return (strlen($field) >= $min && strlen($field) <= $max);
  }

  /**
   * Check user_login existence into DB
   */
  public static function uniqueness(string $field)
  {
    $db = App::getContainer()->resolve(Database::class);
    $user = $db->query("SELECT * FROM authors WHERE login_name = :user_login", [
      'user_login' => $field
    ])->fetch();
    return !$user;
  }
}