<?php

namespace Core\Forms;

use Core\Validator;
use Core\ValidatorException;

class PostCreate extends Form
{
  public function validate()
  {
    // Checking given [data] with rules
    foreach ($this->data as $field => $value)
    {
      // Check REQUIRE
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
    // Return
    return $this;
  }
}