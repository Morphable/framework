<?php

namespace Morphable\Routing\Interfaces;

interface Route {

  public function __construct ($method, $route, $middleware, $callback);

  public function getMethod ();

  public function getRoute ();

  public function getMiddleware ();

  public function getCallback ();

}
