<?php

namespace ValahIvanMaulana\App\Middleware;

use ValahIvanMaulana\App\Model\User;
use ValahIvanMaulana\Core\Middleware;

class GuestMiddleware implements Middleware {
     public static function handle(string $key, string $page) : void {
          session_start();
          if (isset($_COOKIE['remember_token_user'])) {
               $token = $_COOKIE['remember_token_user'];

               $user = new User();
               $id_user = $user->where('remember_token', '=', $token)->pluck('id_user');
               if ($id_user) $_SESSION['id_user'] = $id_user;
          }

          if (isset($_SESSION[$key])) {
               header("Location: $page");
          }
     }
}