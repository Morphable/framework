<?php

namespace Morphable\Console;

use Console\Commands;

class Console {

  public $commands = [];
  public $connection;
  public $argv;

  function __construct ($connection) {
    $this->connection = $connection;
  }

  public function registerMainCommands () {
    $dir = __DIR__ . '/Commands';

    $commands = \scandir($dir);
    $commands = array_splice($commands, 2);

    foreach($commands as $key => $val) {
      require $dir . '/' . $val;

      $command = str_replace('.php', '', $val);

      $class = 'Morphable\Console\Commands\\'.$command;

      $class = new $class($this->connection);

      $this->registerCommand($class->name, $class);

      $commands[$key] = $command;
    }

    return $commands;
  }

  public function getCommands () {
    return $this->commands;
  }

  public function registerCommand ($name, $object) {
    $this->commands[] = ['name' => $name, 'command' => $object];
    return $this;
  }

  public function setArgv ($argv) {
    $this->argv = $argv;
    return $this;
  }

  public function router () {
    $request = explode(':', $this->argv[1]);

    $requestCommand = $request[0];
    
    $requestParam = (isset($request[1]) ? $request[1] : null);

    $options = array_slice($this->argv, 2);

    foreach ($this->commands as $command) {
      if ($command['name'] == $requestCommand) {
        $command = $command['command'];
        try {
          $command->router($requestParam, $options);
        } catch (Exception $e) {
          echo $e;
        }
      }
    }
  }

}
