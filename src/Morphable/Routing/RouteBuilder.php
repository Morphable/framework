<?php

namespace Morphable\Routing;

use Morphable\Helper;

class RouteBuilder {

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

  public static function buildAndCompare ($url, $route, $callback) {
    $params = self::buildParams($route);
    $params = self::fillParams($url, $params);
    $compare = self::compare($params);
    $urlTooLong = self::urlTooLong($url, $params);

    if ($compare && !$urlTooLong) {
      $params = self::getParams($params);
      $callback($params);
    }
  }

  public static function urlTooLong ($url, $params) {
    $url = Helper::removeEmptyItems(explode('/', $url));
    if (count($url) > count($params)) {
      return true;
    }

    return false;
  }

  public static function compare ($params) {
    $success = true;

    foreach ($params as $param) {
      if ($param['required']) {
        if ($param['value'] == null || $param['value'] == '') {
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

  public static function getParams ($params) {
    $result = [];
    
    foreach ($params as $param) {
      if (!$param['match']) {
        $result[$param['param']] = $param['value'];
      }
    }

    return $result;
  }

  public static function buildParams ($route) {
    $params = [];
    
    $route = Helper::removeEmptyItems(explode('/', $route));

    foreach ($route as $param) {
      if ($param[0] == ':') {
        $params[] = [
          'required' => true,
          'match' => false,
          'param' => substr($param, 1),
          'value' => null,
        ];
      } else if ($param[0] == '?') {
        $params[] = [
          'required' => false,
          'match' => false,
          'param' => substr($param, 1),
          'value' => null
        ];
      } else if ($param == '*') {
        $params[] = [
          'required' => true,
          'match' => false,
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

  // public static function buildParams ($url, $route) {
  //   $result = [];

  //   foreach ($route as $key => $param) {
  //     if ($param != '') {
  //       if ($param[0] == ':' || $param[0] == '?') {
  //         $param = substr($param, 1);
  //         if (isset($url[$key])) {
  //           $result[$param] = $url[$key];
  //         } else {
  //           $result[$param] = false;
  //           break;
  //         }
  //       }
  //     }
  //   }

  //   return $result;
  // }

}
