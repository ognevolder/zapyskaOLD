<?php

namespace Core\Forms;

use Core\App;
use Core\Database;
use Core\Router;
use Core\Session;
use Core\Validator;
use Core\ValidatorException;

class LoginForm
{
  protected array $errors = [];
  protected array $data = [];
  protected $user;
  protected Session $session;
  protected Database $db;

  /**
   * Create a Login Form body with [data] of given $attributes
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
   * Authorising
   */
  public function authorise()
  {
    if (empty($this->errors))
    {
      // Fetch user with login-name
      try
      {
        $this->user = $this->db->query("SELECT * FROM authors WHERE login_name = :login",
        [
          'login' => htmlspecialchars($this->data['user_login'])
        ])->fetch();
      }
      catch (ValidatorException $e)
      {
      $this->session->setFlashMessage($e->errors, 'db');
      Router::redirectBack();
      }
    }

    // Check password
    if (!$this->user || !password_verify($this->data['user_password'], $this->user['password']))
    {
      $this->errors['auth'] = 'Користувача не знайдено';
      ValidatorException::throw($this->errors, $this->data);
    }
    return $this;
  }

  /**
   * Create a user instance into Session
   * @return void
   */
  public function login(): void
  {
    // Set data into Session
    $this->session::setValue('user', ['name' => $this->user['name'], 'login' => $this->user['login_name']]);
  }
}
