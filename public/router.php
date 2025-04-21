<?php

// Якщо запит стосується реального файлу — повертаємо його напряму
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];

    if (is_file($file)) {
        return false;
    }
}

// В іншому випадку завантажуємо основний вхідний файл
require_once __DIR__ . '/index.php';