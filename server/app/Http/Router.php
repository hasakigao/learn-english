<?php

namespace App\Http;

use Laravel\Lumen\Routing\Router as BaseRouter;

class Router extends BaseRouter
{

    /**
     * Register a new route with the given verbs.
     *
     * @param  array|string $methods
     * @param  string $uri
     * @param  \Closure|array|string|callable|null $action
     * @return void
     */
    public function match($methods, $uri, $action = null)
    {
        $this->addRoute(array_map('strtoupper', (array)$methods), $uri, $action);
    }

    public function resource($uri, $controller){
        $this->addRoute('GET', $uri, $controller . '@index');
        $this->addRoute('POST', $uri, $controller . '@create');
        $this->addRoute('GET', $uri . '/{id}', $controller . '@show');
        $this->match(['PUT', 'PATCH'], $uri . '/{id}', $controller . '@update');
        $this->addRoute('DELETE', $uri, $controller . '@delete');
    }

}