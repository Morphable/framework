<?php

namespace Morphable\Database;

use PDO;
use Exception;
use PDOStatement;

class Connection {

  /**
   * @var string
   */
  protected $dbName;

  /**
   * @var string
   */
  protected $user = 'root';

  /**
   * @var string
   */
  protected $pass = '';

  /**
   * @var string
   */
  protected $host = '127.0.0.1';

  /**
   * @var integer
   */
  protected $port = 3306;

  /**
   * @var object
   */
  static $pdo;

  function __construct () {

  }

  /**
   * Set host
   * @param string
   * @return self
   */
  public function setHost ($host) {
    $this->host = $host;
    return $this;
  }

  /**
   * Set port
   * @param integer
   * @return self
   */
  public function setPort ($port) {
    $this->port = $port;
    return $this;
  }

  /**
   * Set db name
   * @param string
   * @return self
   */
  public function setDbName ($dbName) {
    $this->dbName = $dbName;
    return $this;
  }

  /**
   * Set user
   * @param string
   * @return self
   */
  public function setUser ($user) {
    $this->user = $user;
    return $this;
  }

  /**
   * Set pass
   * @param string
   * @return self
   */
  public function setPass ($pass) {
    $this->pass = $pass;
    return $this;
  }

  /**
   * Validate array
   * @param array
   * @return array
   */
  static function validateInstance ($db) {
    return [
      'host' => (!$db['host'] ? '127.0.0.1' : $db['host']),
      'port' => (!$db['port'] ? 3306 : $db['port']),
      'user' => (!$db['user'] ? 'root' : $db['user']),
      'pass' => (!$db['pass'] ? '' : $db['pass']),
      'dbName' => $db['dbName']
    ];
  }

  /**
   * Create static instance
   * @param array
   * @return void
   */
  static function staticInstance ($db) {
    try {
      $db = self::validateInstance($db);
      $pdo = new PDO("mysql:host={$db['host']};port={$db['port']};dbname={$db['dbName']}", $db['user'], $db['pass']);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      self::$pdo = $pdo;
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
    }
  }

  /**
   * Get last inserted id
   * @return integer
   */
  public static function lastInsertedId () {
    return self::$pdo->lastInsertId();
  }

  public static function queryStmt ($sql, $params = []) {
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt;
  }

  public static function count ($sql, $params = []) {
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->rowCount();
  }

  /**
   * Execute a query
   * @param string
   * @return object
   */
  public static function query ($sql, $params = []) {
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute($params);
    return true;
  }

  /**
   * Execute update query
   * @param string sql
   * @param array params
   * @return boolean
   */
  public static function update ($sql, $params) {
    $stmt = self::$pdo->prepare($sql);
    // self::bind($stmt, $params);
    $stmt->execute($params);

    return true;
  }

  /**
   * Execute insert query
   * @param string sql
   * @param array params
   * @return boolean
   */
  public static function insert ($sql, $params) {
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute($params);

    return self::lastInsertedId();
  }

  /**
   * Execute select query
   * @param string sql
   * @param string class
   * @return array
   */
  public static function select ($sql, $params = [], $class = null) {
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute($params);
    return self::fetch($stmt, $class);
  }

  public static function delete ($sql, $params = []) {
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute($params);
    return true;
  }

  /**
   * Fetch a query
   * @param object stmt
   * @param string class
   * @return array
   */
  private static function fetch ($stmt, $class = null) {
    if ($class != null) {
      $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
    } else {
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
    }

    return $stmt->fetchAll();
  }

  /**
   * Bind parameter
   * @param object prepare
   * @param array params
   * @return void
   */
  private static function bind ($prepare, $params) {
    foreach($params as $key => $val) {
      $prepare->bindValue(":$key", $val);
    }
  }

}

