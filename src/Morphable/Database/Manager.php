<?php

namespace Morphable\Database;

class Manager {

  /**
   * @var array
   */
  public $config;

  // private $connection;

  function __construct (Array $config = null) {
    if ($config != null) {
      $this->config = $config;
    }
  }

  public function connection ($config) {
    return Connection::staticInstance($config);
  }

  public function getConnection ($config = null) {
    if ($config == null) {
      return $this->connection($this->config);
    } else {
      return $this->connection($config);
    }
  }
  
  public function table($name, $callback = null) {
    return new Migrations\Table($this->getConnection(), $name, $callback);
  }

}
