<?php

session_start();

require __DIR__ . '/../autoload.php';
require __DIR__ . '/../config.php';

use \Morphable\Database\Connection;
use \Morphable\Database\Manager;

new Manager($appConfig['connection']);
Connection::staticInstance($appConfig['connection']);