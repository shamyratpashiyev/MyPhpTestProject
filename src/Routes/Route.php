<?php
namespace App\Routes;

use Closure;

class Route {
    public string $path;

    public string $method;

    public Closure|array $func;

    public function __construct(string $path, string $method, Closure|array $func) {
        $this->path = $path;
        $this->method = $method;
        $this->func = $func;
    }
}