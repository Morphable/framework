<?php

require_once 'bootstrap.php';

use Morphable\Config;
use Morphable\Database\Connection;
use Morphable\Database\Manager;

$roleSchema = Manager::Schema('roles', function ($table) {
  $table->primary('id');
  $table->varchar('name');
  $table->createdAt();
  $table->updatedAt();
});

$userSchema = Manager::Schema('users', function ($table) {
  $table->primary('id');
  $table->index('role_id');
  $table->varchar('name');
  $table->createdAt();
  $table->updatedAt();
  $table->foreign('role_id', 'roles', 'id');
});
