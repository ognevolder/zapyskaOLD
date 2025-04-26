<?php

namespace Core;

class Template
{
  public static function render(string $templatePath, array $data): string
  {
    if (!file_exists($templatePath)) {
      throw new \Exception("Template file not found: {$templatePath}");
    }
  
    $template = file_get_contents($templatePath);
  
    foreach ($data as $key => $value) {
      // Проста заміна змінних {{key}}
      $template = str_replace('{{' . $key . '}}', htmlspecialchars((string)$value), $template);
    }
  
    return $template;
  }
}
