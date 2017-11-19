<?php

namespace Morphable\Routing\Dispatchers;

use Morphable\Routing\Interfaces;
use Morphable\Routing\Exceptions;
use Morphable\Helper;

class Dispatcher implements Interfaces\Dispatcher {
  
  private $router;
  private $request;

  public $url;
  public $method;

  public $params;
  public $exception = null;

  public function __construct ($router, $request) {
    // header('content-type: application/json');
    // echo \json_encode($router);
    // var_dump($router);
    // die;
    $this->router = $router;
    $this->request = $request;

    $this->url = $this->request->url;
    $this->method = $this->request->method;
    $this->urlToParams();

    return $this;
  }

  public function dispatch () {
    $count = 0;
    foreach ($this->router as $group) {
      $count++;
      $dispatcher = new GroupDispatcher($this, $group);
      if ($this->exception == null) {
        $dispatcher->dispatch();
      } else {
        break;
      }
    }

    if ($count == count($this->router)) {
      $this->setException(new Exceptions\NotFoundException('Route not found'));
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

  public function setException ($exception) {
    $this->exception = $exception;
    return $this;
  }

  public function getException () {
    return $this->exception;
  }

}
