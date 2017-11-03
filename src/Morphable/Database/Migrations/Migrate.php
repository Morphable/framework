<?php

namespace Morphable\Database\Migrations\Migrate;

use Morphable\Database;

class Migrate extends Database\Connection {

  private $db;

  function __construct ($db) {
    $this->dbName = $db->dbName;
    $this->user = $db->user;
    $this->pass = $db->pass;
    $this->host = $db->host;
    $this->port = $db->port;

    $this->db = $db->connectHost();
  }

  public function createDatabase () {
    $query = 'CREATE DATABASE `' . $this->dbName . '`';
    $this->db->exec($query);
    echo 'Database successfully created!';
  }

}
