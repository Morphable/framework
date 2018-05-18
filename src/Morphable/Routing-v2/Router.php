<?php

namespace Morphable\Routing;

/**
 * Router factory
 */
class Router
{

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var object
     */
    private $config;

    /**
     * @param array
     */
    public function __construct()
    {
        $this->config = new Config();
    }

    /**
     * Get config
     * @return object Morphable\Routing\Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get routes
     * @param string method (optional)
     * @return array
     */
    public function getRoutes($method = null)
    {
        if ($method != null)
        {
            return $this->routes[$method];
        }

        return $this->routes;
    }

    /**
     * Add route to router
     * @param string
     * @param string
     * @param callable
     * @return object Routing\Route
     */
    private function addroute($method, $path, $callback)
    {
        $r = new Route($method, $path, $callback);
        $this->routes[$method][] = $r;
        return $r;
    }

    /**
     * Add GET route
     * @param string
     * @param callable
     * @return object Routing\Route
     */
    public function get($path, $callback)
    {
        return $this->addRoute('GET', $path, $callback);
    }

    /**
     * Add POST route
     * @param string
     * @param callable
     * @return object Routing\Route
     */
    public function post($path, $callback)
    {
        return $this->addRoute('POST', $path, $callback);
    }

    /**
     * Add PUT route
     * @param string
     * @param callable
     * @return self
     */
    public function put($path, $callback)
    {
        return $this->addRoute('PUT', $path, $callback);
    }

    /**
     * Add PATCH route
     * @param string
     * @param callable
     * @return self
     */
    public function patch($path, $callback)
    {
        return $this->addRoute('PATCH', $path, $callback);
    }

    /**
     * Add DELETE route
     * @param string
     * @param callable
     * @return self
     */
    public function delete($path, $callback)
    {
        return $this->addRoute('DELETE', $path, $callback);
    }

    /**
     * Cache the routes
     * @param string
     * @return self
     */
    public function setCache($path)
    {
        $this->config->setCache($path);
        return $this;
    }

    /**
     * Let router make use of session
     * @return self
     */
    public function useSession($var = 'framework')
    {
        $this->config->setSession($var);
        return $this;
    }

    /**
     * Keep a log of suspicious tries
     * @param string
     * @return self
     */
    public function setLog($path)
    {
        $this->config->setLog($path);
        return $this;
    }

    /**
     * Log the routes
     * @return void
     */
    public function logRoutes()
    {
        echo "<pre>";
        print_r($this->routes);
        echo "</pre>";
    }

    /**
     * Set event callback
     * @param string
     * @param callable
     * @return self
     */
    public function on($action, $callback)
    {
        $this->config->setAction($action, $callback);
        return $this;
    }

    /**
     * Dispatch routes
     * @return void
     */
    public function dispatch()
    {
        Dispatcher::router($this);
    }

}
