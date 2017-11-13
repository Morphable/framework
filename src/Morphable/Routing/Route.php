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

    $this->req = new Http\Request($this);
    $this->res = new Http\Response($this);

    if ($route == '404') {
      $callback($this->req, $this->res);
    } else {
      if (RouteBuilder::compareMethod($_SERVER['REQUEST_METHOD'], $this->method)) {
        RouteBuilder::buildAndCompare($_SERVER['REQUEST_URI'], $this->route, function ($params) use ($callback) {
          $this->req->params = $params;
          $this->execMiddleware($callback);
          die;
        });
      }
    }

  }

  private function execMiddleware ($callback) {
    foreach ($this->middleware as $middleware) {
      Router::runMiddleware($middleware, $this);
    }
    $callback($this->req, $this->res);
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
