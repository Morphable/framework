<?php

namespace Morphable;

class Helper {

  static function removeEmptyItems ($array) {
    return array_filter($array, function ($value) {
      return $value != '';
    });
  }

  static function allTrue ($array) {
    $allTrue = true;
    foreach ($array as $value) {
      if (!$value) $allTrue = false;
    }

    return $allTrue;
  }

}
