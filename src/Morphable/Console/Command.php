<?php

namespace Morphable\Console;

use Exception;

class Command {

  public $command;
  public $param;
  public $option;

  public $name;

  protected $connection;

  function __construct ($connection) {
    $this->connection = $connection;
  }

  public function router ($param, $options) {
    throw new Exception('Missing public router function');
  }

}
