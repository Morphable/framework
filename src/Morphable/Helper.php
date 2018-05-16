<?php

namespace Morphable;

class Helper {

  static function removeEmptyItems ($array)
  {
    $array = array_filter($array, function ($value) {
      return $value != '';
    });

    return array_values($array);
  }

  static function explodeUrl ($url)
  {
    return self::removeEmptyItems(explode('/', $url));
  }

  static function allTrue ($array)
  {
    $allTrue = true;
    foreach ($array as $value)
    {
      if (!$value) $allTrue = false;
    }

    return $allTrue;
  }

  static function currentUrl ()
  {
    $http = 'http';
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
        $http .= 's';
    }

    $http .= '://';

    $host = $_SERVER['SERVER_NAME'];
    if (isset($_SERVER['SERVER_PORT'])) {
      $host .= ':' . $_SERVER['SERVER_PORT'];
    }

    return $http . $host . $_SERVER['REQUEST_URI'];
  }

  public static function array_overwrite($main, $overwrite)
  {
    foreach($overwrite as $key => $value)
    {
      $main[$key] = $value;
    }

    return $main;
  }

}
