<?php
// app/core/Router.php

namespace App\Core;

class Router {
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Load a user-defined routes file.
     */
    public static function load($file) {
        $router = new static;
        require $file;
        return $router;
    }

    /**
     * Register a GET route.
     */
    public function get($uri, $controller) {
        // Convert route URI to a regex pattern
        $uri = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $uri);
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Register a POST route.
     */
    public function post($uri, $controller) {
        $uri = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $uri);
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Resolve the current request and call the appropriate controller method.
     */
    public function resolve($uri, $method) {
        foreach ($this->routes[$method] as $route => $controllerAction) {
            // Check if the registered route pattern matches the current URI
            if (preg_match("#^$route$#", $uri, $matches)) {
                
                // Extract parameters from the URI (e.g., the 'id')
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                // Explode the controller string 'Controller@method'
                $parts = explode('@', $controllerAction);
                $controllerName = $parts[0];
                $methodName = $parts[1];
                
                // Prepend the full namespace
                $controllerClass = "App\\Controllers\\{$controllerName}";

                if (class_exists($controllerClass)) {
                    $controllerInstance = new $controllerClass();

                    if (method_exists($controllerInstance, $methodName)) {
                        // Call the controller method, passing the captured params
                        return call_user_func_array([$controllerInstance, $methodName], $params);
                    }
                }
            }
        }

        // If no route is found, show a 404 page.
        http_response_code(404);
        die('404 - Page Not Found');
    }
}