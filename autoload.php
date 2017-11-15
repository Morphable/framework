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
$autoloader->addFile($morphablePath . 'Helper.php');

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
// $autoloader->addFolder($morphablePath . 'Routing/');


/**
 * Require Routing v2
 */
$routingV2 = $morphablePath . 'Routing-v2/';
$autoloader->addFolder($routingV2 . 'Exceptions');
$autoloader->addFolder($routingV2 . 'Interfaces');

$autoloader->addFile($routingV2 . 'Middleware.php');

$autoloader->addFile($routingV2 . 'Dispatchers\DispatcherInterface.php');
$autoloader->addFile($routingV2 . 'Dispatchers\Dispatcher.php');
$autoloader->addFile($routingV2 . 'Dispatchers\RouteDispatcher.php');
$autoloader->addFile($routingV2 . 'Dispatchers\GroupDispatcher.php');

$autoloader->addFile($routingV2 . 'Router.php');
$autoloader->addFile($routingV2 . 'RouterFactory.php');
$autoloader->addFile($routingV2 . 'Group.php');

$autoloader->addFile($routingV2 . 'Route.php');

/**
 * Require Console
 */
$autoloader->addFile($consolePath . 'Console.php');
$autoloader->addFile($consolePath . 'Command.php');

/**
 * Execute
 */
$autoloader->autoload();
