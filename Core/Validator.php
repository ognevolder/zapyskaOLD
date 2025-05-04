<?php

namespace Core;

class Validator
{
  protected array $errors = [];

  /**
   * Register $message into [errors] from corresponding $field
   *
   * @param string $field
   * @param string $message
   * @return void
   */
  private function addError(string $field, string $message): void
  {
    $this->errors[$field][] = $message;
  }

  /**
   * Get the errors from [errors]
   *
   * @return array
   */
  public function getErrors(): array
  {
    return $this->errors;
  }

  /**
   * Return (bool) about error existence in [errors]
   *
   * @return boolean
   */
  public function hasErrors(): bool
  {
    return !empty($this->errors);
  }
  
  /**
   * Implements require-logic to posted $value for corresponding $field
   *
   * @param string $field
   * @param string $value
   * @return void
   */
  public function required(string $field, string $value): void
  {
    if (empty($value))
    {
      $this->addError($field, "Поле {$field} є обовʼязковим!");
    }
  }

  // Функція для перевірки мінімальної довжини
  public function minLength($field, $value, $min)
  {
      if (strlen($value) < $min) {
          $this->addError($field, "Поле $field повинно містити хоча б $min символів");
      }
  }
}