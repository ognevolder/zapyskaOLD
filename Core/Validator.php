<?php

namespace Core;

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
  public static function length(string $field, int $min = 6, int $max = INF): bool
  {
    return (strlen($field) >= $min && strlen($field) <= $max);
  }
}