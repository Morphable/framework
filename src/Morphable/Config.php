<?php

namespace Morphable;

class Config {

  /**
   * Database connection
   * @var array
   */
  public static $connection = [
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
  public static $libraries = [];

  /**
   * Root path of the app
   * @var string
   */
  public static $root;

  /**
   * Enviroment
   * @var string
   */
  public static $env;

  /**
   * Url
   * @var string
   */
  public static $url;

  /**
   * Errors
   * @var boolean
   */
  public static $errors = true;

  /**
   * Set config property
   * @param array
   * @return void
   */
  public static function setConfig ($config) {
    foreach ($config as $key => $val) {
      self::$$key = $val;
    }
  }

  /**
   * Get connection property
   * @return array
   */
  public static function getConnection () {
    return self::$connection;
  }

  /**
   * Edit a connection value
   * @param string type
   * @param string value
   * @return void
   */
  public static function setConnectionValue ($type, $value) {
    self::$connection[$type] = $value;
  }

  /**
   * Add a library
   * @param string
   * @return void
   */
  public function addLibrary ($library) {
    self::$libraries[] = $library;
  }

}
