<?php

namespace Morphable\Routing\Dispatchers;

use Morphable\Routing\Interfaces;

class RouteDispatcher implements Interfaces\RouteDispatcher {
  
  private $route;

  public function __construct ($route) {
    $this->route = $route;

    return $this;
  }

  public function buildRoute () {

  }

  public function dispatch ($handler) {
    
  }

  public function match () {

  }

}
