<?php

namespace ValahIvanMaulana\App\Middleware;

use ValahIvanMaulana\Core\Middleware;

class AuthMiddleware implements Middleware {
    public static function handle(string $key, string $page) : void {
          session_start();
          if (!isset($_COOKIE['remember_token_user'])) {
               unset($_SESSION['id_user']);
          }

          if (!isset($_SESSION[$key])) {
               header("Location: $page");
          }
    }
}