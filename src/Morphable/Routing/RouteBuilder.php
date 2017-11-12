<?php

namespace Morphable\Routing;

use Morphable\Helpers;

class RouteBuilder {
  
  private static $url;
  private static $method;

  function __construct () {
    self::$requestUrl = $_SERVER['REQUEST_URI'];
    self::$method = $_SERVER['REQUEST_METHOD'];
  }

  public static function compareRoutes ($url, $route) {
        
  }

  public static function splitUrlAndRoute ($url, $route) {
    return [
      'url' => explode('/', $url),
      'route' => explode('/', $route)
    ];
  }

  public static function buildParams ($url, $route) {
    $result = [];

    $routes = self::splitUrlAndRoute($url, $route);

    $route = $routes['route'];
    $url = $routes['url'];

    foreach ($route as $key => $param) {
      if ($param != '' && $param[0] == ':') {
        $param = ltrim($param, ':');
        if (isset($url[$key])) {
          $result[$param] = $url[$key];
        } else {
          $result[$param] = false;
          break;
        }
      }    
    }

    return $result;
  }

}
