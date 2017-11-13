<?php

namespace Morphable\Http;

class Request {

  public $url;
  public $method;
  public $host;
  public $params;
  public $cookies;
  public $sessions;
  public $server;
  public $route;

  function __construct ($route) {
    $this->route = $route;
    $this->url = $_SERVER['REQUEST_URI'];
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->host = $_SERVER['SERVER_NAME'];
    $this->cookies = $_COOKIE;
    $this->server = $_SERVER;
  }

  public function setParams ($params) {
    $this->params = $params;
    return $this;
  }

}
