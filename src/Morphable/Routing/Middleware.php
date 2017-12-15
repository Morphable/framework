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
    if (isset(Middleware::$middleware[$name])) {
      return Middleware::$middleware[$name];
    } else {
      return null;
    }
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
        if (strlen($mw) > 0) {
          $mw = self::getMiddlewareByName($mw);
          if ($mw != null) {
            $mw($req, $res);
          }
        }
      }
    } else {
      if (strlen($middleware) > 0) {
        $middleware($req, $res);
      }
    }
  } 

}
