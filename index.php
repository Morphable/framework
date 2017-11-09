<?php

require_once 'bootstrap.php';

use Morphable\Database;
use Morphable\Database\Migrations;

$app = new Morphable\Database\Manager(
  $config->connection
);

$users = $app->table('users', function ($table) {
  $table->primary('id');
  $table->varchar('name')->nullable();
  $table->boolean('isBanned')->default(0);
  $table->createdAt();
  $table->updatedAt();
});

$posts = $app->table('posts', function ($table) {
  $table->primary('id');
  $table->index('user_id');
  $table->varchar('username');
  $table->isActive();
  $table->createdAt();
  $table->updatedAt();
  $table->foreign('user_id', 'users', 'id');
});

if (isset($_GET['migrate'])) {
  $type = $_GET['migrate'];

  if ($type == 'create') {
    $users->create();
    $posts->create();
  }

  if ($type == 'refresh') {
    $posts->dropForeignKey('foreign_user_id_users_id');

    $posts->drop();
    $users->drop();

    $users->create();
    $posts->create();
  }

  if ($type == 'drop') {
    $posts->dropForeignKey('foreign_user_id_users_id');
    $posts->drop();
    $users->drop();
  }
}
