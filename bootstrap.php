<?php

require __DIR__ . '/autoload.php';
require __DIR__ . '/config.php';

use Morphable\Config;
use Morphable\Database\Connection;
$config = new Config($appConfig);
$connection = Connection::staticInstance($config->connection);
