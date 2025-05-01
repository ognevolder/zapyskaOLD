<?php

namespace Core;

class Session
{
  // BASIC OPERATIONS

  private readonly string $sessionId;

  /**
   * Check session status and initiate if disabled
   *
   * @return void
   */
  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $this->sessionId = session_id();
  }

  public function getSessionId(): string
  {
    return $this->sessionId;
  }

  /**
   * Register a $value with corresponding $firstKey and (optional) $secondKey into $_SESSION
   *
   * @param string $firstKey
   * @param string $secondKey
   * @param mixed $value
   * @return void
   */
  public static function setValue(string $firstKey, mixed $value, ?string $secondKey = null): void
  {
    if (empty($secondKey))
    {
      $_SESSION[$firstKey] = $value;
    } else {
      if (!isset($_SESSION[$firstKey]) || !is_array($_SESSION[$firstKey])) 
      {
        $_SESSION[$firstKey] = []; // якщо ще не масив — створюємо
      }
      $_SESSION[$firstKey][$secondKey] = $value;
    }
  }

  /**
   * Get a value with corresponding $firstKey and (optional) $secondKey from $_SESSION
   *
   * @param string $firstKey
   * @param string $secondKey
   * @param $default
   */
  public static function getValue(string $firstKey, ?string $secondKey)
  {
    if (empty($secondKey))
    {
      return $_SESSION[$firstKey];
    } else {
      return $_SESSION[$firstKey][$secondKey];
    }
  }

  /**
   * Check existence of value with corresponding $key in $_SESSION
   *
   * @param string $key
   * @return boolean
   */
  public static function hasValue(string $key): bool
  {
    return isset($_SESSION[$key]);
  }

  /**
   * Delete the value with corresponding $key from $_SESSION
   *
   * @param string $key
   * @return void
   */
  public static function removeValue(string $key): void
  {
    unset($_SESSION[$key]);
  }

  /**
   * Destroy the Session and coockies from browser, than restart with new Session id
   *
   * @return void
   */
  public static function destroy(): void
  {
    // Check if Session is active and unset $_SESSION
    if (session_status() === PHP_SESSION_ACTIVE)
    {
      $_SESSION = [];
    }

    // Delete all cookies
    if (ini_get("session.use_cookies"))
    {
      $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',       
            time() - 42000, 
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Destroy session on server
    session_destroy();

    // Close sessopn
    session_write_close();

    // Start a new Session with new ID
    session_start();
    session_regenerate_id(true);
  }

  // --- ---- ---

  // PROJECT-ORIENTED OPERATIONS

  /**
   * Setting a flash-message with corresponding $key into Session
   *
   * @param mixed $value
   * @param string $key
   * @return void
   */
  public function setFlashMessage(mixed $value, string $key): void
  {
    static::setValue('_flash', $value, $key);
  }
  
  /**
   * Get a flash-message with corresponding $key from Session
   *
   * @param string $key
   */
  public function flashMessage(string $key)
  {
    return static::getValue('_flash', $key);
  }

  /**
   * Clear a [_flash]
   *
   * @return void
   */
  public function clearFlashMessage(): void
  {
    static::removeValue('_flash');
  }

  /**
   * Set a $data array with old user's data into Session[old]
   *
   * @param array $data
   * @return void
   */
  public function setOldData(array $data): void
  {
    static::setValue('old', $data);
  }

  /**
   * Return data with corresponding $key from Session[old]
   *
   * @param string $key
   */
  public function getOldData(string $key)
  {
    return static::getValue('old', $key) ?? null;
  }
  
  /**
   * Clear all data from Session[old]
   *
   * @return void
   */
  public function clearOldData(): void
  {
    static::removeValue('old');
  }
}