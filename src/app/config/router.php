<?php
namespace App\Config;
use App\Core\Route;
use App\Core\RouteContext;
class Router
{
    protected $router;

    function __construct()
    {
        $this->router = new Route();

        $this->router->map('get', '/', array('CommentsController', 'index'));

        $this->router->map('post','/add', array('CommentsController','add'));

        $this->router->map('get', '/login', array('AuthController','index'));

        $this->router->map('post', '/login', array('AuthController','login'));

        $this->router->map('get', '/logout', array('AuthController','logout'));

        $this->router->map('get', '/edit/[i:id]', array('CommentsController','edit'));

        $this->router->map('post', '/edit/[i:id]', array('CommentsController','update'));

    }

    public function routing()
    {
        $match = $this->router->match();

        $target = $match['target'];

        $paramMatch = $match['params'];

        $queryMatch = $match['query'];

        $context = new RouteContext($paramMatch, $queryMatch);

        $this->routingController($context, $target);
        

        // if($match && is_callable($target)) {
        //     call_user_func($target, $quering);
        // } else {
        //     // no route was matched
        //     $this->NotFound();
        // }
    }

    //Не доработанная функция на ошибок
    public function routingController($context, $target)
    {
        $controllerName = $target[0];
        $action = $target[1];

        $controllerName = "App\\Controller\\".$controllerName;

        if (class_exists($controllerName)) {
            $controller = new $controllerName($context);
            if (method_exists($controller, $action)) {
                $controller->$action();
            }
        } else {
            $this->NotFound();
        }
    }

    public function NotFound()
    {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        include('src/404.php');
    }
}

 ?>
