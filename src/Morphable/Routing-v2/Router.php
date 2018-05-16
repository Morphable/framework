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
     * Add route to router
     * @param string
     * @param string
     * @param callable
     * @return self
     */
    private function addroute($method, $path, $callback)
    {
        $this->routes[$method][] = new Route($method, $path, $callback);
        return $this;
    }

    /**
     * Add GET route
     * @param string
     * @param callable
     * @return self
     */
    public function get($path, $callback)
    {
        $this->addRoute('GET', $path, $callback);
        return $this;
    }

    /**
     * Add POST route
     * @param string
     * @param callable
     * @return self
     */
    public function post($path, $callback)
    {
        $this->addRoute('POST', $path, $callback);
        return $this;
    }

    /**
     * Add PUT route
     * @param string
     * @param callable
     * @return self
     */
    public function put($path, $callback)
    {
        $this->addRoute('PUT', $path, $callback);
        return $this;
    }

    /**
     * Add DELETE route
     * @param string
     * @param callable
     * @return self
     */
    public function delete($path, $callback)
    {
        $this->addRoute('DELETE', $path, $callback);
        return $this;
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

    }

}
