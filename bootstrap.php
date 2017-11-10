<?php

require __DIR__ . '/autoload.php';
require __DIR__ . '/config.php';

use Morphable\Config;
use Morphable\Database\Connection;
use Morphable\Database\Manager;

$config = new Config($appConfig);
$connection = Connection::staticInstance($config->connection);
$manager = new Manager($config->connection);
