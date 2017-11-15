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

  function __construct () {
    $this->url = $_SERVER['REQUEST_URI'];
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->host = $_SERVER['SERVER_NAME'];
    $this->cookies = $_COOKIE;
    $this->headers = getallheaders();
  }

  public function setParams ($params) {
    $this->params = $params;
    return $this;
  }

}
