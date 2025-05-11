<?php

namespace Core\Forms;

use Core\Validator;
use Core\ValidatorException;

class RegisterForm implements Form
{
  protected array $errors = [];

  public function __construct(public array $attributes)
  {
    // Checking a REQUIRE rule
    foreach ($attributes as $field => $value)
    {
      if (!Validator::required($value))
      {
        $this->errors[$field] = "Поле є обовʼязковим";
      }
    }
  }

  /**
   * Return a Form body if validation confirmed and throw [errors] if opposite.
   *
   * @param array $attributes
   * @return static
   */
  public static function validate(array $attributes): static
  {
    // Створення тіла Form
    $instance = new static($attributes);
    // Перевіряє наявність errors та викидає ValidatorException
    if ($instance->failed())
    {
      $instance->throw();
    }
    return $instance;
  }

  // Helpers
  public function failed(): bool
  {
    return !empty($this->errors);
  }

  public function throw(): void
  {
    ValidatorException::throw($this->errors, $this->attributes);
  }
}
