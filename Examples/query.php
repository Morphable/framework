<?php

use Morphable\Database\Manager;
use Morphable\Database\Connection;

if (isset($_GET['query'])) {
  $query = $_GET['query'];

  if ($query == 'delete') {
    Manager::table('users')
      ->delete()
      ->where('id', '8')
      ->exec();
  }

  if ($query == 'update') {
    Manager::table('users')
      ->update([
        'name' => 'is just updated this name another time'
      ])
      ->whereIn('id', [9, 10, 11])
      ->exec();
  }

  if ($query == 'select') {
    $r = Manager::table('users')
      ->whereIn('users.id', [9, 10, 11])
      ->join('roles', 'id', 'role_id')
      ->orderBy('users.created_at')
      ->select('users.id, users.name, users.email')
      ->exec();
    
    var_dump($r);
  }

  if ($query == 'insert') {
    $r = Manager::table('users')
      ->insert([
        'role_id' => '1',
        'name' => 'hooi',
        'email' => 'hoooi@mail',
        'password' => 'pass'
      ])->exec();

    echo $r;
  }


}
