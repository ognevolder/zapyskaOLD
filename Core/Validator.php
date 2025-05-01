<?php

namespace Core;

class Validator
{
  public $errors = [];

  
  /**
   * Register $message into [errors] from corresponding $field
   *
   * @param string $field
   * @param string $message
   * @return void
   */
  public function addError(string $field, string $message)
  {
    $this->errors[$field][] = $message;
  }
  
  /**
   * Implements require-logic to posted $value for corresponding $Field
   *
   * @param string $field
   * @param string $value
   * @return void
   */
  public function required(string $field, string $value)
  {
    if (empty($value))
    {
      $this->addError($field, "Поле {$field} є обовʼязковим!");
    }
  }
}