<?php

namespace Morphable\Routing;

class Middleware {

  public static $middleware = [];
  private $callback;
  private $name;

  function __construct ($name, $callback) {
    $this->callback = $callback;
    $this->name = $name;

    Middleware::$middleware[$this->name] = $this->callback;
    return $this;
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

}
