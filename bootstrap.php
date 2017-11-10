<?php

namespace Bootstrap;

require __DIR__ . '/AutoLoad.php';
require __DIR__ . '/config.php';

use Morphable\Config;
use Morphable\Database;

$config = new Config($appConfig);

$connection = Database\Connection::staticInstance($config->connection);

