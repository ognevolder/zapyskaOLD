<?php

namespace Core\Forms;

use Core\Validator;
use Core\ValidatorException;

class LoginForm implements Form
{
  protected array $errors = [];
  protected array $data = [];

  /**
   * Create a Login Form body with [data] of given $attributes
   *
   * @param array $attributes
   */
  public function __construct(array $attributes)
  {
    // Filling [data] with given $attributes
    foreach ($attributes as $field => $value)
    {
      $this->data[$field] = $value;
    }
    return $this;
  }

  /**
   * Validate a [data] and fill a [errors]
   */
  public function validate()
  {
    // Checking given [data] with rules
    foreach ($this->data as $field => $value)
    {
      // Checking a REQUIRE rule
      if (!Validator::required($value))
      {
        $this->errors[$field] = 'Поле є обовʼязковим';
      }
    }
    // Throwing [errors]
    if (!empty($this->errors))
    {
      ValidatorException::throw($this->errors, $this->data);
    }
  }
}