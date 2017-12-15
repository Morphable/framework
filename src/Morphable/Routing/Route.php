<?php

namespace Morphable\Routing;

class Route {
  
  public $method;
  public $route;
  public $middleware;

  function __construct ($method = 'get', $route, $middleware = []) {
    $this->method = $method;
    $this->route = $route;
    $this->middleware = $middleware;

  }

  public function middleware ($middleware) {
    if (is_array($middleware)) {
      $this->middleware = array_merge($this->middleware, $middleware);
    } else {
      $this->middleware[] = $middleware;
    }

    return $this;
  }

  public function get () {
    return get_object_vars($this);
  }

  public function getMethod () {
    return $this->method;
  }

  public function getRoute () {
    return $this->route;
  }

  public function getMiddleware () {
    return $this->middleware;
  }

}
