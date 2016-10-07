<?php
namespace App\Config;
use AltoRouter;
class Router
{
    protected $router;

    function __construct()
    {
        $this->router = new AltoRouter();

        $this->router->map('get', '/', function() {
            $this->routingController('CommentsController', 'index');
        });

        $this->router->map('get', '/descname', function() {
            $this->routingController('CommentsController', 'descname');
        });

        $this->router->map('get', '/ascname', function() {
            $this->routingController('CommentsController', 'ascname');
        });

        $this->router->map('get', '/descemail', function() {
            $this->routingController('CommentsController', 'descemail');
        });

        $this->router->map('get', '/ascemail', function() {
            $this->routingController('CommentsController', 'ascemail');
        });

        $this->router->map('get', '/descdate', function() {
            $this->routingController('CommentsController', 'descdate');
        });

        $this->router->map('get', '/ascdate', function() {
            $this->routingController('CommentsController', 'ascdate');
        });

        $this->router->map('post', '/add', function() {
            $this->routingController('CommentsController', 'add');
        });

        //Пути роутинга прописать
    }

    public function routing()
    {
        $match = $this->router->match();
        $target = $match['target'];
        $param = $match['params'];

        if($match && is_callable( $match['target'])) {
            call_user_func_array( $match['target'], $match['params'] );
        } else {
            // no route was matched
            $this->NotFound();
        }
    }

    //Не доработанная функция на ошибок
    public function routingController($controllerName, $action, $param = null)
    {
        $controllerName = "App\\Controller\\".$controllerName;
        if (class_exists($controllerName)) {
            $controller = new $controllerName;
            if (method_exists($controller, $action)) {
                if (is_null($param)) {
                    $controller->$action();
                }  else {
                    $controller->$action($param);
                }
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
