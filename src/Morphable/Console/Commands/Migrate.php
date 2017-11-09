<?php

namespace Morphable\Console\Commands;

use Morphable\Console\Command;

class Migrate extends Command {

  public $name = 'migrate';

  public function router ($param, $options) {
    if ($param == 'create' || empty($param)) {
      echo 'creating!';
    } else if ($param == 'drop') {
      echo 'dropping!';
    } else if ($param == 'refreshing') {
      echo 'refreshing';
    }
  }

}
