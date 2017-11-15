<?php

namespace Morphable\Routing;

class Route {
  
  private $method;
  private $route;
  private $middleware;
  // private $callback;

  function __construct ($method = 'get', $route, $middleware = []) {
    $this->method = $method;
    $this->route = $route;
    $this->middleware = $middleware;
    // $this->$callback = $callback;
  }

  public function middleware ($middleware) {
    if (is_array($middleware)) {
      $this->middleware = array_merge($this->middleware, $middleware);
    } else {
      $this->middleware[] = $middleware;
    }

    return $this;
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

  public function getCallback () {
    return $this->callback();
  }

}
