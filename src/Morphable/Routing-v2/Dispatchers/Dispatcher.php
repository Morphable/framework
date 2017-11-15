<?php

namespace Morphable\Routing\Dispatchers;

use Morphable\Routing\Interfaces;
use Morphable\Helper;

class Dispatcher implements Interfaces\Dispatcher {
  
  private $router;
  private $request;

  public $url;
  public $method;

  public $params;

  public function __construct ($router, $request) {
    $this->router = $router;
    $this->request = $request;

    $this->url = $this->request->url;
    $this->method = $this->request->method;

    $this->urlToParams();

    return $this;
  }

  public function dispatch () {
    foreach ($this->router as $group) {
      $dispatcher = new GroupDispatcher($this, $group);
      $dispatcher->dispatch();
    }
  }

  public function urlToParams () {
    $this->params = Helper::explodeUrl($this->url);
    return $this;
  }

  public function getUrl () {
    return $this->url;
  }

  public function getMethod () {
    return $this->method;
  }

  public function getParams () {
    return $this->params;
  }

}
