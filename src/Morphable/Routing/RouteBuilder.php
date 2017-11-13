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
    $count = 0;

    if (count($url) != count($route)) return false;

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

  public static function compare ($params) {

    $success = true;

    foreach ($params as $param) {

      if ($param['required']) {
        if ($param['value'] == null) {
          $success = false;
          break;
        }
      }

      if ($param['match']) {
        if ($param['value'] != $param['param']) {
          $success = false;
          break;
        }
      }

    }

    return $success;

  }

  public static function fillParams ($url, $params) {
    $url = Helper::removeEmptyItems(explode('/', $url));

    foreach ($params as $key => &$value) {
      if (isset($url[$key])) {
        $value['value'] = $url[$key];
      }
    }

    return $params;
  }

  public static function buildRoute ($route) {
    $params = [];
    
    $route = Helper::removeEmptyItems(explode('/', $route));

    foreach ($route as $param) {
      if ($param[0] == ':') {
        $params[] = [
          'match' => false,
          'required' => true,
          'param' => substr($param, 1),
          'value' => null,
        ];
      } else if ($param[0] == '?') {
        $params[] = [
          'match' => false,
          'required' => false,
          'param' => substr($param, 1),
          'value' => null
        ];
      } else if ($param == '*') {
        $params[] = [
          'match' => false,
          'required' => true,
          'param' => '*',
          'value' => null
        ];
      } else {
        $params[] = [
          'match' => true,
          'required' => true,
          'param' => $param,
          'value'=> null
        ];
      }
    }
    
    return $params;
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
