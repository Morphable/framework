<?php

namespace Morphable\Routing;

class Middleware {

  public static $middleware = [];
  private $callback;
  private $name;

  function __construct ($name, $callback) {
    $this->callback = $callback;
    $this->name = $name;

    Middleware::$middleware[$this->name] = $callback;
    return $this;
  }

  public static function getMiddlewareByName ($name) {
    return Middleware::$middleware[$name];
  }

  public static function getMiddleware () {
    return Middleware::$middleware;
  }

  public function getCallback () {
    return $this->callback;
  }

  public function getName () {
    return $this->name;
  }

  static function exec ($middleware, $req, $res) {
    if (is_array($middleware)) {
      foreach ($middleware as $mw) {
        $mw = self::getMiddlewareByName($mw);
        $mw($req, $res);
      }
    } else {
      $middleware($req, $res);
    }
  } 

}
