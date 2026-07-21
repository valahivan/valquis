<?php 
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__  . '/web.php';
require_once __DIR__  . '/core/config.php';

// Redirect to login page
$url = $_SERVER['REQUEST_URI'];
if (str_ends_with($url, '/')) {
    header('Location: login-page');
}