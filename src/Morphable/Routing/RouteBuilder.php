<?php

namespace Morphable\Routing;

use Morphable\Helper;

class RouteBuilder {
  
  private static $url;
  private static $method;

  function __construct () {
    self::$requestUrl = $_SERVER['REQUEST_URI'];
    self::$method = $_SERVER['REQUEST_METHOD'];
  }

  public static function compareMethod ($method1, $method2) {
    $method1 = strtoupper($method1);
    $method2 = strtoupper($method2);

    if ($method1 == 'ANY') {
      return true;
    } else if ($method1 == $method2) {
      return true;
    } else {
      return false;
    }
  }

  public static function splitAndBuildParams ($url, $route) {
    $exploded = self::splitUrlAndRoute($url, $route);
    $url = $exploded['url'];
    $route = $exploded['route'];

    return [
      'url' => $url,
      'route' => $route,
      'params' => self::buildParams($url, $route)
    ];
  }

  public static function compareRoute ($url, $route) {
    
    
    $check = [];

    foreach ($route as $key => $value) {
      $firstChar = $value[0];
      if (isset($url[$key])) {
        if ($firstChar !== ':' && $firstChar != '?') {
          if ($value == $url[$key]) {
            $check[] = true;
          } else {
            $check[] = false;
          }
        } else {
          $check[] = true;
        }
      } else {
        if ($firstChar == '?') {
          $check[] = true;
        } else {
          $check[] = false;
        }
      }
    }

    return Helper::allTrue($check);
  }

  public static function splitUrlAndRoute ($url, $route) {
    $url = Helper::removeEmptyItems(explode('/', $url));
    $route = Helper::removeEmptyItems(explode('/', $route));

    return [
      'url' => $url,
      'route' => $route
    ];
  }

  public static function buildParams ($url, $route) {
    $result = [];

    foreach ($route as $key => $param) {
      if ($param != '') {
        if ($param[0] == ':' || $param[0] == '?') {
          $param = substr($param, 1);
          if (isset($url[$key])) {
            $result[$param] = $url[$key];
          } else {
            $result[$param] = false;
            break;
          }
        }
      }
    }

    return $result;
  }

}
