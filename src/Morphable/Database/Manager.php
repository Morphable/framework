<?php

namespace Morphable\Database;

class Manager {

  /**
   * @var array
   */
  public $config;

  function __construct (Array $config = null) {
    if ($config != null) {
      $this->config = $config;
    }
  }

  public function query () {
    return new Query\Query($this->connection);
  }
  
  public function table($name, $callback = null) {
    return new Migrations\Table($name, $callback, [
      'engine' => $this->config['engine'],
      'charset' => $this->config['charset'],
      'collation' => $this->config['collation'],
      'strict' => $this->config['strict'],
      'prefix' => $this->config['prefix'],
    ]);
  }

}
