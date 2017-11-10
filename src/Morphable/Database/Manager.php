<?php

namespace Morphable\Database;

class Manager {

  /**
   * @var array
   */
  public $config;

  /**
   * @var object
   */
  public $connection;

  // private $connection;

  function __construct ($connection, Array $config = null) {
    $this->connection = $connection;
    if ($config != null) {
      $this->config = $config;
    }
  }
  
  public function table($name, $callback = null) {
    return new Migrations\Table($this->connection, $name, $callback, [
      'engine' => $this->config['engine'],
      'charset' => $this->config['charset'],
      'collation' => $this->config['collation'],
      'strict' => $this->config['strict'],
      'prefix' => $this->config['prefix'],
    ]);
  }

}
