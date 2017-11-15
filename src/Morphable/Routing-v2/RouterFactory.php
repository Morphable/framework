<?php

namespace Morphable\Routing;

class RouterFactory implements RouterInterface {

  public static $groups = [];
  
  public $routes = [];
  public $middleware = [];
  public $prefix = '';
  public $type;

  public function __construct () {
    $this->type = 'Factory';
    RouterFactory::$groups[] = $this;
  }

  public function prefix ($prefix, $callback) {
    $group = $this->addGroup('prefix', $prefix, $callback);
    return $group;
  }

  public function middleware ($middleware, $callback) {
    $group = $this->addGroup('middleware', $middleware, $callback);
    return $group;
  }

  public function addGroup ($type, $value, $callback) {
    if ($type == 'middleware') {
      $group = new Group ($this, $value, null, $callback);
    } else if ($type == 'prefix') {
      $group = new Group ($this, null, $value, $callback);
    }

    RouterFactory::$groups[] = $group;
    return $group;
  }

  public function addRoute ($method, $route, $middleware, $callback) {

  }

  public function get ($route, $middleware, $callback = null) {

  }

  public function post ($route, $middleware, $callback = null) {

  }

  public function put ($route, $middleware, $callback = null) {

  }

  public function patch ($route, $middleware, $callback = null) {

  }

  public function delete ($route, $middleware, $callback = null) {

  }

  public function option ($route, $middleware, $callback = null) {

  }

  public function any ($route, $middleware, $callback = null) {

  }

  static function getGroups () {
    return RouterFactory::$groups;
  }

  public function setPrefix ($prefix) {
    $this->prefix = $prefix;
    return $this;
  }

  public function addPrefix ($prefix) {
    $this->prefix .= $this->normalizeRoute($prefix);
    return $this;
  }

  public function getPrefix () {
    return $this->prefix;
  }

  public function setMiddleware ($middleware) {
    $this->middleware = $middleware;
    return $this;
  }

  public function addMiddleware ($middleware) {
    if (is_array($middleware)) {
      $this->middleware =  array_merge($this->middleware, $middleware); 
    } else {
      $this->middleware[] = $middleware;
    }
    return $this;
  }

  public function getMiddleware () {
    return $this->middleware;
  }

  public function getRoutes () {
    return $this->routes;
  }

  public function normalizeRoute ($route) {
    if ($route != '') {
      if ($route[0] != '/') {
        $route = '/' . $route;
      }

      if ($route[strlen($route) -1] == '/') {
        $route = substr($route, 0, -1);
      }
    }

    return $route;
  }

}
