<?php

define('_RootPath', __DIR__ . '/');
define('_MorphablePath', _RootPath . 'src/Morphable/');
define('_ConsolePath', _MorphablePath . 'Console/');
define('_DatabasePath', _MorphablePath . 'Database/');

require _MorphablePath . 'AutoLoader.php';

$autoloader = new Morphable\Autoloader;

/**
 * Require Base
 */
$autoloader->addFile('config.php');
$autoloader->addFile(_DatabasePath . 'Connection.php');

/**
 * Require Migrations
 */
$migrationsPath = _DatabasePath . 'Migrations/';
$autoloader->addFile($migrationsPath . 'Table.php');
$autoloader->addFile($migrationsPath . 'Field.php');
$autoloader->addFile($migrationsPath . 'TableBuilder.php');
unset($migrationsPath);

$autoloader->autoload();
