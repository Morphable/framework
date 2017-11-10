<?php

namespace Morphable\Database\Query;

use Morphable\Database\Connection;

class QueryBuilder {
 
  public static function buildWhere ($where) {
    $column = $where[0];
    $compare = $where[1];
    $value = $where[2];

    return "WHERE $column $compare $value";
  }

  public static function buildJoin ($type, $table, $join) {
    $foreignTable = $join[0];
    $foreignColumn = $join[1];
    $value = $join[2];

    return "$type JOIN `$foreignTable` on $foreignTable.$foreignColumn = $table.$value";
  }

  public static function buildOrderBy ($value) {
    $column = $value[0];
    $order = $value[1];

    return "order by $column $order";
  }

  public static function buildGroupBy ($value) {
    $column = $value[0];
    $order = $value[1];

    return "group by $column $order";
  }

  public static function buildUpdate ($object) {
    $query = "";
    $query .= "UPDATE `$object->table` SET" . " ";

    foreach ($object->fields as $key => $value) {
      $query .= "`$key` = :$key, ";
    }

    $query = substr($query, 0, -2);

    if ($object->where) {
      $query .= " ";
      $query .= self::buildWhere($object->where);
    }

    echo $query;

    return $query;
  }

  public static function buildInsert ($object) {
    $query = "";
    $query .= "INSERT INTO `$object->table` (";

    foreach ($object->fields as $key => $value) {
      $query .= "`$key`, ";
    }

    $query = substr($query, 0, -2);

    $query .= ") VALUES (";

    foreach ($object->fields as $key => $value) {
      $query .= ":$key, ";
    }

    $query = substr($query, 0, -2);

    $query .= ")";

    return $query;
  }

  public static function buildDelete ($object) {
    $query = "";
    $query .= "DELETE FROM `$object->table` ";
    if ($object->where) {
      $query .= self::buildWhere($object->where);
    }

    return $query;
  }

  public static function buildSelect ($object) {
    $query = "";
    $query .= "SELECT $object->select FROM `$object->table`" . " ";
    if ($object->where) {
      $query .= self::buildWhere($object->where) . " ";
    }

    if ($object->orderBy) {
      $query .= self::buildOrderBy($object->orderBy) . " ";
    }

    if ($object->groupBy) {
      $query .= self::buildGroupBy($object->groupBy) . " ";
    }
    
    foreach ($object->joins['inner'] as $inner) {
      $query .= self::buildJoin('inner', $object->table, $inner) . " ";
    }

    foreach ($object->joins['outer'] as $inner) {
      $query .= self::buildJoin('outer', $object->table, $inner) . " ";
    }

    foreach ($object->joins['left'] as $inner) {
      $query .= self::buildJoin('left', $object->table, $inner) . " ";
    }

    foreach ($object->joins['right'] as $inner) {
      $query .= self::buildJoin('right', $object->table, $inner) . " ";
    }
    
    return $query;
  }

  public static function execInsert ($object) {
    $query = self::buildInsert($object);
    echo $query;
    return Connection::insert($query, $object->fields);
  }

  public static function execUpdate ($object) {
    $query = self::buildUpdate($object);
    return Connection::update($query, $object->fields);
  }

  public static function execSelect ($object) {
    $query = self::buildSelect($object);
    return Connection::select($query);
  }

  public static function execDelete ($object) {
    $query = self::buildDelete($object);
    return Connection::delete($query);
  }

}
