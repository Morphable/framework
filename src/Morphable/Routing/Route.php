<?php

namespace Morphable\Routing;

use Morphable\Http;

class Route {

  public $route;
  public $middleware = [];
  public $method;
  public $callback;
  public $prefix = '';
  public $suffix = '';
  public $req;
  public $res;

  function __construct ($method, $route, $middleware, $callback) {
    $this->method = $method;
    $this->route = $route;
    $this->middleware = $middleware;
    $this->callback = $callback;

    $this->req = new Http\Request($this);
    $this->res = new Http\Response($this);

    $callback($this->req, $this->res);

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

}
