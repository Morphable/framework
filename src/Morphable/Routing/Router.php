<?php

namespace Morphable\Routing;

class Router {

  public static $routes = [];
  public static $middleware = [];
  public static $groups = [];

  function __construct () {

  }

  public static function getRoutes () {
    return self::$routes;
  }

  public static function getMiddleware () {
    return self::$middleware;
  }

  public static function runMiddleware ($name, $route) {
    self::$middleware[$name]($route->req, $route->res);
  }

  public static function middleware ($name, $function) {
    self::$middleware[$name] = $function;
  }

  public static function add ($method, $url, $middleware, $callback) {
    $route = new Route($method, $url, $middleware, $callback);
    self::$routes[] = $route;
    return $route;
  }

  public static function get ($url, $middleware = [], $callback = null) {
    if (is_callable($middleware)) {
      $callback = $middleware;
      $middleware = [];
    }

    return self::add('GET', $url, $middleware, $callback);
  }

  public static function post ($url, $middleware = [], $callback = null) {
    if (is_callable($middleware)) {
      $callback = $middleware;
      $middleware = [];
    }

    return self::add('POST', $url, $middleware, $callback);
  }

  public static function PUT ($url, $middleware = [], $callback = null) {
    if (is_callable($middleware)) {
      $callback = $middleware;
      $middleware = [];
    }

    return self::add('PUT', $url, $middleware, $callback);
  }

  public static function patch ($url, $middleware = [], $callback = null) {
    if (is_callable($middleware)) {
      $callback = $middleware;
      $middleware = [];
    }

    return self::add('PATCH', $url, $middleware, $callback);
  }

  public static function delete ($url, $middleware = [], $callback = null) {
    if (is_callable($middleware)) {
      $callback = $middleware;
      $middleware = [];
    }

    return self::add('DELETE', $url, $middleware, $callback);
  }

  public static function any ($url, $middleware = [], $callback = null) {
    if (is_callable($middleware)) {
      $callback = $middleware;
      $middleware = [];
    }

    return self::add('ANY', $url, $middleware, $callback);
  }

}
