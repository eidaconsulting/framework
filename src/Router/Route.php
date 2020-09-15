<?php

namespace Core\Router;

use Core\Controller\Controller;

/**
 * Class Route
 *
 * @package Core\Router
 */
class Route
{

    /**
     * @var string
     */
    private $path;
    /**
     * @var
     */
    private $callable;
    /**
     * @var array
     */
    private $matches = [];
    /**
     * @var array
     */
    private $params = [];

    /**
     * Route constructor.
     *
     * @param $path
     * @param $callable
     */
    public function __construct ($path, $callable)
    {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    /**
     * @param $param
     * @param $regex
     * @return $this
     */
    public function with ($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }

    /**
     * @param $url
     * @return bool
     */
    public function match ($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    /**
     * @return mixed
     */
    public function call ()
    {
        if (is_string($this->callable)) {

            $modules = explode('.', $this->callable);
            $explodes = explode('#', $modules[0]);


            if (isset($modules[1])) {
                $controller = '\\Modules\\' . ucfirst($modules[1]) . '\\' . ucfirst($explodes[0]) . '\\' . ucfirst($explodes[1]) . 'Controller';
                $controllerFile = ROOT . '/modules/' . ucfirst($modules[1]) . '/' . ucfirst($explodes[0]) . '/' . ucfirst($explodes[1]) . 'Controller.php';
            } else {
                $controller = '\\App\\Controller\\' . ucfirst($explodes[0]) . '\\' . ucfirst($explodes[1]) . 'Controller';
                $controllerFile = ROOT . '/app/Controller/' . ucfirst($explodes[0]) . '/' . ucfirst($explodes[1]) . 'Controller.php';
            }

            if (!isset($explodes[2])) {
                $methode = 'View';
            } else {
                $methode = $explodes[2];
            }


            if (file_exists($controllerFile)) {
                $controller = new $controller();
                return call_user_func_array([$controller, $methode], $this->matches);
            } else {
                $controller = new Controller();
                $controller->notFound();
            }
        } else {
            return call_user_func_array($this->callable, $this->matches);
        }
    }

    /**
     * @param $params
     * @return mixed|string
     */
    public function getUrl ($params)
    {
        $path = $this->path;
        foreach ($params as $k => $v) {
            $path = str_replace(":$k", $v, $path);
        }
        return $path;
    }

    /**
     * @param $match
     * @return string
     */
    private function paramMatch ($match)
    {
        if (isset($this->params[$match[1]])) {
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

}