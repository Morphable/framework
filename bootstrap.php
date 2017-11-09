<?php

namespace Bootstrap;

require __DIR__ . '/AutoLoad.php';

use Morphable\Config;

$config = new Config();
$config->root = __DIR__ . '/';
$config->env = 'dev';
$config->url = 'localhost:8000';

$config->setConnectionValue('dbName', 'test');
$config->setConnectionValue('prefix', 'tbl_');

