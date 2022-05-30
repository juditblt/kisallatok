<?php
namespace App;

use App\Exception\RouteNotFoundException;

class Router
{
    // GET localhost/home
    // POST localhost/edit/sajt

    private array $routes = array();

    public function register(string $requestMethod, string $route, callable|array $action){
        $this->routes[$requestMethod][$route] = $action;
        /*
         'get' => [
            'home' => (){...}
          ],
          'post' => [
            'edit/sajt' => (){...}
          ]
        */
        return $this;
    }

    public function get(string $route, callable|array $action) {
        return $this->register('get', $route, $action);
    }
    public function post(string $route, callable|array $action) {
        return $this->register('post', $route, $action);
    }

    public function getRoutes() : array{
        return $this->routes;
    }

    public function resolve(string $requestUri, string $requestMethod){
        // $_SERVER['REQUEST_URI'] = "/index.php/home/sajt?key=value&key1=value1";
        $route = explode('?',$requestUri)[0];
        $method = strtolower($requestMethod);

        $action = $this->routes[$method][$route] ?? null;

        if (!$action){ // $action === null
            throw new RouteNotFoundException();
        }

        //action tömb vagy fgv?

        if (is_callable($action)){
            return call_user_func($action);
        }

        if (is_array($action)){
            //[LibraryController::class, 'index']
            [$class, $function] = $action;
            /*
             $class = $action[0];
             $function = $action[1];
             */
            if (class_exists($class)){
                $object = new $class();
                if (method_exists($object, $function)){
                    return call_user_func_array([$object,$function], []);
                    /* /home
                    $object = new LibraryController();
                    return $object->index();
                    */
                }
            }
        }

        throw new RouteNotFoundException();
    }
}