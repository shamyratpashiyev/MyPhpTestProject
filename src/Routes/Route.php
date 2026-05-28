<?php
namespace App\Routes;

class Route {
    public string $path;

    public string $method;

    public object $func;

    public function __construct(string $path, string $method, callable $func) {
        $this->path = $path;
        $this->method = $method;
        $this->func = $func;
    }
}