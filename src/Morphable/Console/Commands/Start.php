<?php

namespace Morphable\Console\Commands;

use Morphable\Console\Command;

class Start extends Command {

  public function router ($options) {
    if (isset($options)) {
      foreach ($options as $option) {
        $option = explode('=', $option);
        $this->up($option[1]);
      }
    }
  }

  public function up ($port = 8000) {
    shell_exec('php -S localhost:' . $port);
  }

}
