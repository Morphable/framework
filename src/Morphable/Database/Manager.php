<?php

namespace Morphable\Database;

class Manager {

  /**
   * @var array
   */
  static $config;

  function __construct (Array $config = null) {
    if ($config != null) {
      self::$config = $config;
    }
  }

  public static function Schema ($name, $callback = null) {
    return new Migrations\Schema($name, $callback, [
      'engine' => self::$config['engine'],
      'charset' => self::$config['charset'],
      'collation' => self::$config['collation'],
      'strict' => self::$config['strict'],
      'prefix' => self::$config['prefix'],
    ]);
  }
  
  public static function Table ($name) {
    return new Query\Query($name);
  }

  public static function query ($query, $params) {
    return Connection::select($query, $params);
  }

  public static function select ($query, $params) {
    return Connection::select($query, $params);
  }

  public static function insert ($query, $params) {
    return Connection::insert($query, $params);
  }

  public static function update ($query, $params) {
    return Connection::update($query, $params);
  }

  public static function AddForeignKey ($tbl1, $field1, $tbl2, $field2) {
    return Migrations\TableBuilder::addForeignKey($tbl1, $field1, $tbl2, $field2);
  }

  public static function DropForeignKey ($table, $constraint) {
    return Migrations\TableBuilder::dropForeignKey($table, $constraint);
  }

  public static function DropIfExists($table) {
    return Migrations\TableBuilder::drop($table);
  }

  public static function CreateTable($table) {
    return Migrations\TableBuilder::create($table);
  }

}
