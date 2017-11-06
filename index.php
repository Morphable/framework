<?php

require_once 'init.php';

use Morphable\Database;
use Morphable\Database\Migrations;
use Migrations\TableBuilder;

$users = new Migrations\Table('users', function ($table) {
  $table->primary('id');
  $table->varchar('name')->nullable();
  $table->boolean('isBanned')->default(0);
  $table->createdAt();
  $table->updatedAt();
});

$posts = new Migrations\Table('posts', function ($table) {
  $table->primary('id');
  $table->index('userId');
  $table->varchar('username');
  $table->isActive();
  $table->createdAt();
  $table->updatedAt();
  $table->foreign('userId', 'users', 'id');
});

echo Migrations\TableBuilder::build($users);
echo PHP_EOL;
echo PHP_EOL;
echo Migrations\TableBuilder::build($posts);
