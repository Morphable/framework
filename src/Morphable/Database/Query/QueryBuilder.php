<?php

namespace Morphable\Database\Query;

use Morphable\Database\Connection;

class QueryBuilder {
 
  /**
   * Build a where query
   * @param array
   * @return string
   */
  public static function buildWhere ($where) {
    $column = $where[0];
    $compare = $where[1];
    $value = $where[2];

    if (is_array($value)) {
      $sql = "WHERE $column $compare (";
      foreach($value as $bind) {
        $sql .= "?, ";
      }
      $sql = substr($sql, 0, -2);
      $sql .= ")";

      return $sql;
    } else {
      return "WHERE $column $compare ?";
    }

  }

  /**
   * Build an inner join query
   * @param string type
   * @param string table
   * @param array join
   * @return string
   */
  public static function buildJoin ($type, $table, $join) {
    $foreignTable = $join[0];
    $foreignColumn = $join[1];
    $value = $join[2];

    $type = strtoupper($type);

    return "$type JOIN `$foreignTable` on $table.$value = $foreignTable.$foreignColumn";
  }

  /**
   * Build an order by query
   * @param array
   * @return string
   */
  public static function buildOrderBy ($value) {
    $column = $value[0];
    $order = $value[1];

    return "order by $column $order";
  }

  /**
   * Build a group by query
   * @param array
   * @return string
   */
  public static function buildGroupBy ($value) {
    $column = $value[0];
    $order = $value[1];

    return "group by $column $order";
  }

  /**
   * Build an update query
   * @param object
   * @return string
   */
  public static function buildUpdate ($object) {
    $query = "";
    $query .= "UPDATE `$object->table` SET" . " ";

    foreach ($object->fields as $key => $value) {
      $query .= "`$key` = ?, ";
      $object->addBind($value);
    }

    $query = substr($query, 0, -2);

    if ($object->where) {
      $query .= " " . self::buildWhere($object->where) . " ";
      if (is_array($object->where[2])) {
        foreach ($object->where[2] as $bind) {
          $object->addBind($bind);
        }
      } else {
        $object->addBind($object->where[2]);
      }
    }

    return $query;
  }

  /**
   * Build an insert query
   * @param object
   * @return string
   */
  public static function buildInsert ($object) {
    $query = "";
    $query .= "INSERT INTO `$object->table` (";

    foreach ($object->fields as $key => $value) {
      $query .= "`$key`, ";
    }

    $query = substr($query, 0, -2);

    $query .= ") VALUES (";

    foreach ($object->fields as $key => $value) {
      $query .= "?, ";
      $object->addBind($value);
    }

    $query = substr($query, 0, -2);

    $query .= ")";

    return $query;
  }

  /**
   * Build a delete query
   * @param object
   * @return string
   */
  public static function buildDelete ($object) {
    $query = "";
    $query .= "DELETE FROM `$object->table` ";
    
    if ($object->where) {
      $query .= " " . self::buildWhere($object->where) . " ";
      if (is_array($object->where[2])) {
        foreach ($object->where[2] as $bind) {
          $object->addBind($bind);
        }
      } else {
        $object->addBind($object->where[2]);
      }
    }

    return $query;
  }

  /**
   * Build a select query
   * @param object
   * @return string
   */
  public static function buildSelect ($object) {
    $query = "";
    $query .= "SELECT $object->select FROM `$object->table`" . " ";

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

    if ($object->where) {
      $query .= self::buildWhere($object->where) . " ";
      if (is_array($object->where[2])) {
        foreach ($object->where[2] as $bind) {
          $object->addBind($bind);
        }
      } else {
        $object->addBind($object->where[2]);
      }
    }

    if ($object->orderBy) {
      $query .= self::buildOrderBy($object->orderBy) . " ";
    }

    if ($object->groupBy) {
      $query .= self::buildGroupBy($object->groupBy) . " ";
    }
    
    return $query;
  }

  public static function execCount ($object) {
    $query = self::buildSelect($object);
    return Connection::count($query, $object->binds);
  }

  /**
   * Execute an insert query
   * @param object
   * @return method
   */
  public static function execInsert ($object) {
    $query = self::buildInsert($object);
    return Connection::insert($query, $object->binds);
  }

  /**
   * Execute an update query
   * @param object
   * @return method
   */
  public static function execUpdate ($object) {
    $query = self::buildUpdate($object);
    return Connection::update($query, $object->binds);
  }

  /**
   * Execute a select query
   * @param object
   * @return method
   */
  public static function execSelect ($object) {
    $query = self::buildSelect($object);
    return Connection::select($query, $object->binds);
  }

  /**
   * Execute a delete query
   * @param object
   * @return method
   */
  public static function execDelete ($object) {
    $query = self::buildDelete($object);
    return Connection::delete($query, $object->binds);
  }

}
