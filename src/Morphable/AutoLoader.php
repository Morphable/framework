<?php

namespace Morphable;

class AutoLoader {

  private $files = [];

  function __construct () {
    spl_autoload_register([$this, '__autoload']);
  }

  public function addFolder ($folder) {
    $files = \scandir($folder);
    $files = array_slice($files, 2);
    foreach ($files as $file) {
      $this->files[] = $folder . '/' . $file;
    }
    return $this;
  }

  public function addFile ($file) {
    $this->files[] = $file;
    return $this;
  }

  private function __autoload ($class) {
    if(file_exists($class)) {
      require_once $class;
    }
  }

  public function autoLoad () {
    foreach ($this->files as $file) {
      $this->__autoload($file);
    }
  }

}
