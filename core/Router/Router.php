<?php

namespace Core\Router;


use Core\Controller\Controller;

/**
 * Class Router
 *
 * @package Core\Router
 */
class Router
{

    /**
     * @var
     */
    private $url;
    /**
     * @var array
     */
    private $routes = [];
    /**
     * @var array
     */
    private $namedRoutes = [];

    /**
     * Router constructor.
     *
     * @param $url
     */
    public function __construct ($url) {
        $this->url = $url;
    }

    /**
     * @param      $path
     * @param      $callable
     * @param null $name
     * @return Route
     */
    public function get($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * @param      $path
     * @param      $callable
     * @param null $name
     * @return Route
     */
    public function post($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * @param $path
     * @param $callable
     * @param $name
     * @param $method
     * @return Route
     */
    private function add($path, $callable, $name, $method){
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null){
            $name = $callable;
        }
        if($name){
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    /**
     * @return mixed
     * @throws RouterException
     */
    public function run() {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->match($this->url)){
                return $route->call();
            }
        }

        $controller = new Controller();
        $controller->notfound();

        //throw new RouterException('No routes marches');
    }

    /**
     * @param       $name
     * @param array $params
     * @return mixed
     * @throws RouterException
     */
    public function url($name, $params = []){
        if(!isset($this->namedRoutes[$name])){
            throw new RouterException('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

}