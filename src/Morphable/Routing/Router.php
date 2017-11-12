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

  public static function get ($url, $callback) {
    return self::add('GET', $url, $callback);
  }

  public static function post ($url, $callback) {
    return self::add('POST', $url, $callback);
  }

  public static function put ($url, $callback) {
    return self::add('PUT', $url, $callback);
  }

  public static function patch ($url, $callback) {
    return self::add('PATCH', $url, $callback);
  }

  public static function DELETE ($url, $callback) {
    return self::add('DELETE', $url, $callback);
  }

}
