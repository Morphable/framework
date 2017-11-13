<?php

namespace Morphable;

class Helper {

  static function removeEmptyItems ($array) {
    $array = array_filter($array, function ($value) {
      return $value != '';
    });

    return array_values($array);
  }

  static function allTrue ($array) {
    $allTrue = true;
    foreach ($array as $value) {
      if (!$value) $allTrue = false;
    }

    return $allTrue;
  }

}
