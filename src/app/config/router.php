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

        // $this->router->map('get', '/[i:id]', function() {
        //     $this->routingController('CommentsController', 'index');
        // });

        // $this->router->map('get', '/', 'CommentsController', 'index', $query);
        // });

        // $this->router->map('get', '/descname', function() {
        //     $this->routingController('CommentsController', 'descname');
        // });
        //
        // $this->router->map('get', '/ascname', function() {
        //     $this->routingController('CommentsController', 'ascname');
        // });
        //
        // $this->router->map('get', '/descemail', function() {
        //     $this->routingController('CommentsController', 'descemail');
        // });
        //
        // $this->router->map('get', '/ascemail', function() {
        //     $this->routingController('CommentsController', 'ascemail');
        // });
        //
        // $this->router->map('get', '/descdate', function() {
        //     $this->routingController('CommentsController', 'descdate');
        // });
        //
        // $this->router->map('get', '/ascdate', function() {
        //     $this->routingController('CommentsController', 'ascdate');
        // });
        //
        // $this->router->map('post', '/add', function() {
        //     $this->routingController('CommentsController', 'add');
        // });
        //
        // $this->router->map('get', '/edit/[i:id]/', function() {
        //     $this->routingController('CommentsController', 'add');
        // });
        //Пути роутинга прописать

        $this->router->map('get', '/', array('CommentsController', 'index'));
    }

    public function routing()
    {
        $match = $this->router->match();

        $target = $match['target'];

        $paramMatch = $match['params'];

        $queryMatch = $match['query'];

        $context = new RouteContext($paramMatch, $queryMatch);

        $this->routingController($context, $target);
        //var_dump($quering);

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
