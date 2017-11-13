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

    $this->check(function () use ($callback) {
      $this->execMiddleware($callback);
    });
  }

  private function execMiddleware ($callback) {
    foreach ($this->middleware as $middleware) {
      Router::runMiddleware($middleware, $this);
    }
    $callback($this->req, $this->res);
  }

  private function check ($callback) {
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    $split = RouteBuilder::splitAndBuildParams($url, $this->route);
    if (RouteBuilder::compareMethod($method, $this->method)) {
      if (RouteBuilder::compareRoute($split['url'], $split['route'])) {
        $this->req->setParams($split['params']);
        $callback();
      }
    }
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
