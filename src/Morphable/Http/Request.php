<?php

namespace Morphable\Http;

class Request {

  public static $url;
  public static $method;
  public static $host;
  public static $params;
  public static $cookies;
  public static $sessions;
  public static $server;
  public $route;

  function __construct ($route) {
    $this->route = $route;
    self::$url = $_SERVER['PATH_INFO'];
    self::$method = $_SERVER['REQUEST_METHOD'];
    self::$host = $_SERVER['SERVER_NAME'];
    self::$cookies = $_COOKIE;
    self::$sessions = $_SESSION;
    self::$server = $_SERVER;
  }

  public function url () {
    return self::$url;
  }

  public function params () {
    // return self::$params;
  } 


}
