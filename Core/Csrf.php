<?php

namespace Core;

class Csrf
{
  public static function generateToken(): string
  {
    // Check exsistance in Session
    if (!Session::hasValue('_csrf_token')) {
      Session::setValue('_csrf_token', bin2hex(random_bytes(32)));
  }

  return Session::getValue('_csrf_token');
  }

  public static function insertToken(): void
  {
    $token = self::generateToken();
    echo '<input type="hidden" name="_csrf" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
  }

  public static function validateToken(string $token): bool
  {
    return Session::hasValue('_csrf_token') && hash_equals(Session::getValue('_csrf_token'), $token);
  }

  public static function removeToken(): void
  {
    Session::removeValue('_csrf_token');
  }
}