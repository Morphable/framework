<?php

namespace Morphable\Routing;

class RouterBuilder {
  
  private static $url;
  private static $method;

  function __construct () {
    self::$requestUrl = $_SERVER['PATH_INFO'];
    self::$method = $_SERVER['REQUEST_METHOD'];
  }

  

}
