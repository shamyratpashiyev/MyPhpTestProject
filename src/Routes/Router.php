<?php
namespace App\Routes;

use App\Routes\Route;
use Exception;
use Illuminate\Support\Collection;


class Router {

    /**
     * @var Collection<Route>
     */
    private static Collection $routes;

    public static function initializeRoutes() {
        Router::$routes = collect(
            [
                new Route("/hello-world", "GET", function() { echo "Hello World!"; })
            ]
        );
    }

    public static function dispatch(string $path, string $method) {
        $route = Router::$routes->where(fn(Route $x)=> $x->path == $path && $x->method == $method)->first();
        // If the route is not specified
        if (!$route) {
            http_response_code(404);
            echo "404 - Page Not Found";
            return;
        }
        ($route->func)();
    }
}