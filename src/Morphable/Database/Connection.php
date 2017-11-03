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

  public function connectHost () {
    try {
      $pdo = new PDO($this->getConnectionHost(), $this->user, $this->pass);
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

