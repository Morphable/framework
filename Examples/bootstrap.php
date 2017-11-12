<?php

session_start();

require __DIR__ . '/../autoload.php';
require __DIR__ . '/../config.php';

use Morphable\Config;
use Morphable\Database\Connection;
use Morphable\Database\Manager;

Config::setConfig($appConfig);
Connection::staticInstance(Config::getConnection());

new Manager(Config::getConnection());
