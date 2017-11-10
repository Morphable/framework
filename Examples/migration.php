<?php

use Morphable\Database\Manager;

if (isset($_GET['migrate'])) {

  $migrate = $_GET['migrate'];

  $roleSchema = Manager::Schema('roles', function ($table) {
    $table->primary('id');
    
    $table->varchar('name');
    $table->text('desc')->nullable();
    $table->int('priority')->default(0);

    $table->createdAt();
    $table->updatedAt();
  });
  
  $userSchema = Manager::Schema('users', function ($table) {
    $table->primary('id');
    $table->index('role_id');
    
    $table->varchar('name');
    $table->varchar('email');
    $table->varchar('password');
    $table->boolean('is_suspended')->default(0);
    
    $table->createdAt();
    $table->updatedAt();

    $table->foreign('role_id', 'roles', 'id');
  });

  $postSchema = Manager::Schema('posts', function ($table) {
    $table->primary('id');
    $table->index('author');

    $table->varchar('title');
    $table->text('content');
    $table->isActive();

    $table->createdAt();
    $table->updatedAt();

    $table->foreign('author', 'users', 'id');
  });

  $commentSchema = Manager::Schema('comments', function ($table) {
    $table->primary('id');
    $table->index('parent_id');
    $table->varchar('parent_type');

    $table->text('content');
    $table->isActive();

    $table->createdAt();
    $table->updatedAt();
  });

  if ($migrate == 'up') {
    Manager::CreateTable($roleSchema);
    Manager::CreateTable($userSchema);
    Manager::CreateTable($postSchema);
    Manager::CreateTable($commentSchema);
  } else if ($migrate == 'refresh') {
    Manager::DropForeignKey('posts', 'foreign_author_users_id');
    Manager::DropForeignKey('users', 'foreign_role_id_roles_id');

    Manager::DropIfExists('posts');
    Manager::DropIfExists('comments');
    Manager::DropIfExists('users');
    Manager::DropIfExists('roles');

    Manager::CreateTable($roleSchema);
    Manager::CreateTable($userSchema);
    Manager::CreateTable($postSchema);
    Manager::CreateTable($commentSchema);
  } else if ($migrate == 'down') {
    Manager::DropForeignKey('posts', 'foreign_author_users_id');
    Manager::DropForeignKey('users', 'foreign_role_id_roles_id');

    Manager::DropIfExists('posts');
    Manager::DropIfExists('comments');
    Manager::DropIfExists('users');
    Manager::DropIfExists('roles');
  }

}

