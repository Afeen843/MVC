<?php
declare(strict_types=1);

namespace App\Bootstrap;

class Router
{
    const string REQUEST_METHODE_GET = 'GET';
    const string REQUEST_METHODE_POST = 'POST';
    private array $routes = [];
    private array $middlewares = [];

    public function __toString():string
    {
        return json_encode($this->routes, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
    }

    public function registerMiddleware(array $middleware):void
    {
        $this->middlewares = array_merge($this->middlewares, $middleware);
    }

    public function get(String $route, Callable|Array $method, string|array $middleware = []):void
    {
        $this->routes[Router::REQUEST_METHODE_GET][$route] = [
            'method' => $method,
            'middleware' => $this->normalizeMiddleware($middleware),
        ];
    }

    public function post(String $route, Callable|Array $method,string|array $middleware = []):void
    {
        $this->routes[Router::REQUEST_METHODE_POST][$route] = [
            'method' => $method,
            'middleware' => $this->normalizeMiddleware($middleware),
        ];
    }

    private function normalizeMiddleware(string|array $middleware):array
    {
        if(!is_array($middleware)) {
            $middleware = [$middleware];
        }

        return array_map(function ($name){
            return $this->middlewares[$name] ?? null;
        },$middleware);
    }

    public function printRoutes():void
    {
        var_dump('<pre>',$this->routes,'</pre>');
    }

    private function getRouterHandler(string $uri, string $requestMethod)
    {
        foreach ($this->routes[$requestMethod] as $route => $routeData) {
            $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>\d+)', $route);
            if (preg_match('@^' . $pattern . '$@', $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return [
                    'method' => $routeData['method'],
                    'params' => $params,
                    'middleware' => $routeData['middleware'],
                ];
            }
        }

        View::render('not_found');
        exit();
    }


    private function runMiddleware(array $middleware, callable $engine,$params = [])
    {
        $next = $engine;
        foreach (array_reverse($middleware) as $name => $middleware) {
            $next = function ($params) use ($middleware, $next) {
                $method = new $middleware;
                return $method->handle($params, $next);
            };
        }

        $next($params);
    }

    function handleRequest(string $uri, string $requestMethod):void
    {
        extract($this->getRouterHandler($uri, $requestMethod));

        $engine = function () use ($method, $params,$middleware) {
            if (is_callable($method) && !is_array($method)) {
                call_user_func_array($method, $params);
            }

            if (is_array($method)) {
                [$controller, $action] = $method;
                if (method_exists($controller, $action)) {
                    call_user_func_array([new $controller, $action], $params);
                } else {
                    throw new \Exception("$action not found in $controller");
                }

            }


        };

        $this->runMiddleware($middleware, $engine,$params);
    }

}