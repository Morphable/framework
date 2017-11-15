<?php

namespace Morphable\Routing;

class Router implements Interfaces\Router {

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

    if (is_callable($middleware)) {
      $callback = $middleware;
      $middleware = [];
    }

    $route = $this->prefix . $this->normalizeRoute($route);
    $middleware = array_merge($this->middleware, $middleware);

    $routeObject = new Route(strtolower($method), $route, $middleware);

    $this->routes[] = [
      'route' => $routeObject,
      'handler' => $callback
    ];

    return $routeObject;
  }

  public function setPrefix ($prefix) {
    $this->prefix = $prefix;
    return $this;
  }

  public function addPrefix ($prefix) {
    $this->prefix .= $this->normalizeRoute($prefix);
    return $this;
  }

  public function setMiddleware ($middleware) {
    $this->middleware = $middleware;
    return $this;
  }

  public function addMiddleware ($middleware) {
    if (is_array($middleware)) {
      $this->middleware = array_merge($middleware, $this->middleware); 
    } else {
      $this->middleware[] = $middleware;
    }
    return $this;
  }


}
