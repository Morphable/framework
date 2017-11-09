<?php

require __DIR__ . '/src/Morphable/Helper.php';
require __DIR__ . '/AutoLoad.php';

$db = new \Morphable\Database\Connection();
$db->setDbName('test');

$db = $db->getInstance();
