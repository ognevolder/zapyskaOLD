<?php

namespace Core;
use Exception;

class ValidatorException extends Exception
{
  public readonly array $errors;
  public readonly array $old;

  public function __construct(array $errors, array $old)
  {
    parent::__construct("The validation was failed.");
    $this->errors = $errors;
    $this->old = $old;
  }

  /**
   * Throw a ValidatorException body with [$errors] and [$old].
   *
   * @param array $errors
   * @param array $old
   * @return never
   */
  public static function throw(array $errors, array $old): never
  {
    throw new static($errors, $old);
  }
}