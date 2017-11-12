<?php

namespace Morphable\Routing;

class RouterBuilder {
  
  public static $requestUrl;

  function __construct () {
    self::$requestUrl = $_SERVER['PATH_INFO'];
  }



}
