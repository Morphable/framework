<?php
$rootPath = __DIR__ . '/';
$morphablePath = $rootPath . 'src/Morphable/';
$databasePath = $morphablePath . 'Database/';
$consolePath = $morphablePath . 'Console/';

require $morphablePath . 'AutoLoader.php';

$autoloader = new Morphable\Autoloader;

/**
 * Require Base
 */
$autoloader->addFile('config.php');
$autoloader->addFile($databasePath . 'Connection.php');
$autoloader->addFile($databasePath . 'Manager.php');

/**
 * Require Migrations
 */
$migrationsPath = $databasePath . 'Migrations/';
$autoloader->addFile($migrationsPath . 'Table.php');
$autoloader->addFile($migrationsPath . 'Field.php');
$autoloader->addFile($migrationsPath . 'TableBuilder.php');

/**
 * Require Console
 */
$autoloader->addFile($consolePath . 'Console.php');
$autoloader->addFile($consolePath . 'Command.php');

$autoloader->autoload();
