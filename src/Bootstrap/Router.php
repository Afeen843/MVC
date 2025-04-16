<?php
declare(strict_types=1);

namespace App\Bootstrap;

class Router
{
    const string REQUEST_METHODE_GET = 'GET';
    const string REQUEST_METHODE_POST = 'POST';
    private array $routes = [];

    public function __toString():string
    {
        return json_encode($this->routes, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
    }

    public function get(String $route, Callable|Array $method):void
    {
        $this->routes[Router::REQUEST_METHODE_GET][$route] = $method;
    }

    public function post(String $route, Callable|Array $method):void
    {
        $this->routes[Router::REQUEST_METHODE_POST][$route] = $method;
    }

    public function printRoutes():void
    {
        var_dump('<pre>',$this->routes,'</pre>');
    }

    private function getRouterHandler(string $uri, string $requestMethod)
    {
        foreach ($this->routes[$requestMethod] as $route => $method) {

            $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<$1>\d+)', $route);
            if (preg_match('@^' . $pattern . '$@', $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return [$method,$params];
            }
        }

        View::render('not_found');
    }

    function handleRequest(string $uri, string $requestMethod):void
    {
        [$method,$params] = $this->getRouterHandler($uri,$requestMethod);

         if(is_callable($method) && !is_array($method)) {
             call_user_func_array($method,$params);
         }

         if(is_array($method)) {
             [$controller, $action] = $method;
             if(method_exists($controller, $action)) {
                 call_user_func_array([new $controller, $action], $params);
             }else{
                 throw new \Exception('Method not found');
             }

         }


    }

}