<?php

$appConfig = [
  'connection' => [
    'host' => 'localhost',
    'port' => 3306,
    'user' => 'me',
    'pass' => '',
    'dbName' => 'generic_tests',
    'engine' => 'InnoDB',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'strict' => true,
    'prefix' => ''
  ],
  'root' => __DIR__ . '/',
  'env' => 'dev',
  'url' => 'localhost:8000'
];
