<?php

namespace Core\Forms;

use Core\App;
use Core\Database;
use Core\Router;
use Core\Session;
use Core\Validator;
use Core\ValidatorException;

class UpdateForm
{
  protected array $errors = [];
  protected array $data = [];
  protected array $user = [];
  protected Session $session;
  protected Database $db;

  /**
   * Create a Update-Form body with [data] of given $attributes
   *
   * @param array $attributes
   */
  public function __construct(array $attributes)
  {
    // Fetch singletons
    $this->db = App::getContainer()->resolve(Database::class);
    $this->session = App::getContainer()->resolve(Session::class);

    // Filling [data] with given $attributes
    foreach ($attributes as $field => $value)
    {
      $this->data[$field] = $value;
    }
    // Return instance
    return $this;
  }

  /**
   * Validate a [data] and fill a [errors]
   */
  protected function validate()
  {
    // Checking given [data] with rules
    foreach ($this->data as $field => $value)
    {
      // Check PASSWORD
      if ($field == 'user_password')
      {
        $user_password = $this->data['user_password'];
        if (Validator::required($user_password) && !Validator::password($user_password, 6, 24))
        {
          $this->errors['user_password'] = 'Пароль повинен містити мінімум 6 символів';
        }
      }

      // Check UNIQUENESS
      if ($field == 'user_login')
      {
        $user_login = $this->data['user_login'];
        if (!Validator::uniqueness($user_login))
        {
          $this->errors['user_login'] = "Користувацький логін {$user_login} вже зареєстровано";
        }
      }

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

  /**
   * Data update
   *
   * @return void
   */
  public function update(): void
  {
    if (empty($this->errors))
    {
      try
      {
        $this->db->query("UPDATE authors SET name = :name, password = :password, login_name = :login WHERE id = :id",
        [
          'name' => htmlspecialchars($this->data['user_name']),
          'password' => htmlspecialchars(password_hash($this->data['user_password'], PASSWORD_BCRYPT)),
          'login_name' => htmlspecialchars($this->data['user_login']),
          'id' => Session::getValue('user', 'id')
        ]);
      }
      catch (ValidatorException $e)
      {
      $this->session->setFlashMessage($e->errors, 'db');
      Router::redirectBack();
      }
    }
  }


  /**
   * Create a user instance into Session
   * @return void
   */
  public function login(): void
  {
    // Set data into Session
    $this->session::setValue('user', [
      'name' => $this->data['user_name'],
      'login' => $this->data['user_login'],
      'admin' => $this->data['admin']]);
  }
}