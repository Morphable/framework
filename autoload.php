<?php

$rootPath = __DIR__ . '/';
$morphablePath = $rootPath . 'src/Morphable/';
$databasePath = $morphablePath . 'Database/';
$consolePath = $morphablePath . 'Console/';

require $morphablePath . 'AutoLoader.php';

$autoloader = new Morphable\Autoloader;

/**
 * Require Exceptions
 */
$autoloader->addFolder($morphablePath . 'Exceptions');

/**
 * Require Base
 */
$autoloader->addFile($morphablePath . 'Config.php');
$autoloader->addFile($databasePath . 'Connection.php');
$autoloader->addFile($databasePath . 'Manager.php');

/**
 * Require request and response
 */
$httpPath = $morphablePath . 'Http/';
$autoloader->addFile($httpPath . 'Request.php');
$autoloader->addFile($httpPath . 'Response.php');

/**
 * Require Migrations
 */
$migrationsPath = $databasePath . 'Migrations/';
$autoloader->addFile($migrationsPath . 'Schema.php');
$autoloader->addFile($migrationsPath . 'Field.php');
$autoloader->addFile($migrationsPath . 'TableBuilder.php');

/**
 * Require Query
 */
$queryPath = $databasePath . 'Query/';
$autoloader->addFile($queryPath . 'Query.php');
$autoloader->addFile($queryPath . 'QueryBuilder.php');

/**
 * Require Routing
 */
$routingPath = $morphablePath . 'Routing/';
$autoloader->addFile($routingPath . 'Route.php');
$autoloader->addFile($routingPath . 'Router.php');
$autoloader->addFile($routingPath . 'RouterBuilder.php');

/**
 * Require Console
 */
$autoloader->addFile($consolePath . 'Console.php');
$autoloader->addFile($consolePath . 'Command.php');

/**
 * Execute
 */
$autoloader->autoload();
