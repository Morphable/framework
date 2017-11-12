<?php

namespace Morphable\Routing;

class Router {

  public static $routes = [];

  function __construct () {

  }

  public static function add ($method, $url, $callback) {
    $route = new Route($method, $url, $callback);
    self::$routes[] = $route;
    return $route;
  }

  public static function prefix ($prefix, $callback) {
    
  }
  
  public static function suffix ($suffix, $callback) {

  }

  public static function middleware ($middleware, $callback) {

  }

}
