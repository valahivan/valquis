<?php 

namespace ValahIvanMaulana\Core;

class Router {
    private static array $routes = [];

    public static function get(string $route, array $callback) {
        self::$routes[] = ['method' => "GET", 'route' => $route, 'callback' => $callback];
    }

    public static function post(string $route, array $callback) {
        self::$routes[] = ['method' => "POST", 'route' => $route, 'callback' => $callback];
    }

    public static function put(string $route, array $callback) {
        self::$routes[] = ['method' => "PUT", 'route' => $route, 'callback' => $callback];
    }

    public static function delete(string $route, array $callback) {
        self::$routes[] = ['method' => "DELETE", 'route' => $route, 'callback' => $callback];
    }

    public static function run() {
        $pathInfo = "/";
        if (isset($_SERVER['PATH_INFO'])) $pathInfo = $_SERVER['PATH_INFO'];
  
        $method = $_SERVER['REQUEST_METHOD'];
        $spoofing = $_POST['_method'] ?? false;
        
        if ($method == "POST" && $spoofing && $spoofing == "PUT") $method = "PUT";
        if ($method == "POST" && $spoofing && $spoofing == "DELETE") $method = "DELETE";

        $found = FALSE;
        foreach (self::$routes as $route) {
            $pathOnly = strtok($route['route'], '?');
            if ($pathInfo === $pathOnly && $method === $route['method']) {
                $controller = new $route['callback'][0];
                $function = $route['callback'][1];

                switch ($method) {
                    case 'GET':
                        isset($_GET) ? $controller->$function($_GET) : $controller->$function();
                        break;
                    case 'POST':
                        $controller->$function($_POST);
                        break;
                    case 'PUT':
                        $controller->$function($_GET['id'], $_POST);
                        break;
                    case 'DELETE':
                        $controller->$function($_GET['id']);
                        break;
                    default:
                        echo "METHOD TIDAK VALID!!";
                        break;
                }
                $found = TRUE;
                break;
            }
        }

        if (!$found) {
            http_response_code(404);
            
            $status_code = "404";
            $title = "Halaman Tidak Ditemukan!";
            $message = "Sayangnya halaman ini tidak pernah dibuat oleh developer web ini";

            return include_once 'views/error.php';
        }
    }
}