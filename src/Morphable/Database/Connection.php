<?php

namespace Morphable\Database;

use PDO;
use Exception;
use PDOStatement;

class Connection {

  protected $dbName;
  protected $user = 'root';
  protected $pass = '';
  protected $host = '127.0.0.1';
  protected $port = 3306;

  function __construct () {
  
  }

  public function setHost ($host) {
    $this->host = $host;
    return $this;
  }

  public function setPort ($port) {
    $this->port = $port;
    return $this;
  }

  public function setDbName ($dbName) {
    $this->dbName = $dbName;
    return $this;
  }

  public function setUser ($user) {
    $this->user = $user;
    return $this;
  }

  public function setPass ($pass) {
    $this->pass = $pass;
    return $this;
  }

  private function getConnectionHost ($with = '') {
    $host = 'mysql:host=' . $this->host . ';port=' . $this->port;

    if ($with == 'name') {
      return $host.';dbname=' . $this->dbName;
    } else {
      return $host;
    }
  }

  static function validateInstance ($db) {
    return [
      'host' => (!$db['host'] ? '127.0.0.1' : $db['host']),
      'port' => (!$db['port'] ? 3306 : $db['port']),
      'user' => (!$db['user'] ? 'root' : $db['user']),
      'pass' => (!$db['pass'] ? '' : $db['pass']),
      'dbName' => $db['dbName']
    ];
  }

  static function staticInstance ($db) {
    try {
      $db = self::validateInstance($db);
      $pdo = new PDO("mysql:host={$db['host']};port={$db['port']};dbname={$db['dbName']}", $db['user'], $db['pass']);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
    }
  }

  public function getInstance () {
    try {
      $pdo = new PDO($this->getConnectionHost('name'), $this->user, $this->pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
    }
  }

}

