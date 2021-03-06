<?php

namespace Morphable\Http;

class Request implements Interfaces\Request {

  public $url;
  public $method;
  public $host;
  public $params;
  public $cookies;
  public $headers;

  public $fullUrl;

  function __construct () {
    
    $this->url = rtrim(explode('?',$_SERVER['REQUEST_URI'])[0], '/');
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->host = $_SERVER['SERVER_NAME'];
    $this->cookies = $_COOKIE;
    $this->headers = getallheaders();
    $this->fullUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    return $this;
  }

  public function getHost () {
    return $this->host;
  }

  public function getUrl () {
    return $this->url;
  }

  public function getMethod () {
    return $this->method;
  }

  public function getHeaders () {
    return $this->headers;
  }

  public function getHeader ($name) {
    return $this->headers[$name];
  }

  public function getCookies () {
    return $this->cookies;
  }

  public function getCookie ($name) {
    return $this->cookies[$name];
  }

  public function getParams () {
    return $this->params;
  }

  public function setParams ($params) {
    $this->params = $params;
    return $this;
  }

}
