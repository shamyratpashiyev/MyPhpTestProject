<?php
// Enabling autoloader
require_once __DIR__ . '/../vendor/autoload.php';


use App\Routes\Router;
use Dotenv\Dotenv;

// Initializing Dotenv targeting project root folder
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Routing the request off to the Router
Router::initializeRoutes();
Router::dispatch(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $_SERVER['REQUEST_METHOD']);