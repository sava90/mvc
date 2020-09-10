<?php
class Router
{
    private $routes = [];

    public function __construct(array $routes = [])
    {
        $this->routes = $routes;
    }

    public function handleRequest()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (array_key_exists($url, $this->routes)) {
            $controller = 'Controller\\'.$this->routes[$url]['controller'].'Controller';
            $action = $this->routes[$url]['action'].'Action';

            if (is_array($controllerMethods = get_class_methods($controller))  && in_array($action, $controllerMethods)) {
                call_user_func(array(new $controller, $action));
            } else {
                $this->notFound();
            }
        } else {
            $this->notFound();
        }
    }

    private function notFound()
    {
        header("Status: 404 Not Found");
        exit;
    }
}