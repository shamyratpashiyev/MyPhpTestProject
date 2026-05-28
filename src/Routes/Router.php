<?php
namespace App\Routes;

use App\Controllers\MainController;
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
                new Route("/hello-world", "GET", function() { echo 'Hello world'; }),
                new Route("/hey", "GET", [MainController::class, "Index"]),
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
        // If it is callable or Controller reference
        if(is_callable($route->func)) {
            ($route->func)();
        }
        else if (is_array($route->func)){
            [$controllerClass, $methodName] = $route->func;

            // Instantiate the controller dynamically on demand!
            $controllerInstance = new $controllerClass();
            $controllerInstance->$methodName();
        }
    }
}