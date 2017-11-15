<?php

namespace Morphable\Routing\Dispatchers;

use Morphable\Routing\Interfaces;

class GroupDispatcher implements Interfaces\GroupDispatcher {
  
  private $dispatcher;
  private $group;
  private $routes;

  public function __construct ($dispatcher, $group) {
    $this->dispatcher = $dispatcher;
    $this->group = $group;
    $this->routes = $this->group->routes;

    return $this;
  }

  public function validateMethod ($route) {
    if ($route->method == 'any' || $route->method == \strtolower($this->dispatcher->getMethod())) {
      return true;
    }

    return false;
  }

  public function dispatch () {
    foreach ($this->routes as $route) {
      if ($this->validateMethod($route['route'])) {
        $object = new RouteDispatcher($route['route']);
        $object->dispatch($route['handler']);
      }
    }
  }

}
