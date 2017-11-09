<?php

namespace Morphable;

class Config {

  /**
   * Database connection
   * @var array
   */
  public $connection = [
    'host' => 'localhost',
    'port' => 3306,
    'user' => 'root',
    'pass' => '',
    'dbName' => '',
    'engine' => 'InnoDB',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'strict' => true,
    'prefix' => '',
  ];

  /**
   * Third party libraries
   * @var array
   */
  public $libraries = [];

  /**
   * Root path of the app
   * @var string
   */
  public $root;

  /**
   * Enviroment
   * @var string
   */
  public $env;

  /**
   * Url
   * @var string
   */
  public $url;

  /**
   * Errors
   * @var boolean
   */
  public $errors = true;

  /**
   * @return self
   */
  function __construct () {
    return $this;
  }

  /**
   * Edit a connection value
   * @param string type
   * @param string value
   * @return self
   */
  public function setConnectionValue ($type, $value) {
    $this->connection[$type] = $value;
    return $this;
  }

  /**
   * Add a library
   * @param string
   * @return self
   */
  public function addLibrary ($library) {
    $this->libraries[] = $library;
    return $this;
  }

}
