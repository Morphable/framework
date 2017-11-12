<?php

namespace Morphable\Routing;

use Morphable\Http;

class Route {

  public $route;
  public $middleware = [];
  public $method;
  public $controller;
  public $callback;
  public $prefix = '';
  public $suffix = '';

  function __construct ($method, $route, $callback) {
    $this->method = $method;
    $this->route = $route;
    
    if (is_callable($callback)) {
      $this->callback = $callback;
      $callback(new Http\Request($this), new Http\Response($this));
    } else {
      $this->controller = $callback;
    }

    return $this;
  }

  public function middleware ($middleware) {
    if (is_array($middleware)) {
      $this->middleware = array_merge($this->middleware, $middleware);
    } else {
      $this->middleware[] = $middleware;
    }

    return $this;
  }

  public function print () {
    var_dump($this);
  }

}
