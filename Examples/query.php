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
      ->whereIn('id', [9, 10, 11])
      ->orderBy('created_at')
      ->select('id, name, email')
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
