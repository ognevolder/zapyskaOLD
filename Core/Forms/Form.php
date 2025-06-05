<?php

namespace Core\Forms;

use Core\App;
use Core\Database;
use Core\Router;
use Core\Session;
use Core\ValidatorException;

abstract class Form
{
  protected array $errors = [];
  protected array $data = [];
  protected Session $session;
  protected Database $db;

  /**
   * Build a Form body with given $attributes
   *
   * @param array $attributes
   */
  public function __construct($attributes)
  {
    $this->session = App::getContainer()->resolve(Session::class);
    $this->db = App::getContainer()->resolve(Database::class);

    foreach ($attributes as $field => $value)
    {
      $this->data[$field] = $value;
    }
  }

  /**
   * Implements validation rules
   */
  abstract protected function validate();

  /**
   * Validate, throw, store in Session and redirect
   */
  public function validationCheck()
  {
    try
    {
      $this->validate();
    }
    catch (ValidatorException $e)
    {
      $this->session->setFlashMessage($e->errors, 'errors');
      $this->session->setFlashMessage($e->old, 'old');
      Router::redirectBack();
    }
    return $this;
  }
}