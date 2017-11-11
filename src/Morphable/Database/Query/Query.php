<?php

namespace Morphable\Database\Query;

use Exception;

class Query {
  
  public $table;

  public $type;
  public $where;
  public $orderBy;
  public $groupBy;
  public $like;

  public $select;
  public $fields;

  public $binds = [];

  public $joins = [
    'inner' => [],
    'outer' => [],
    'left' => [],
    'right' => []
  ];

  public $query;

  function __construct ($table = null) {
    if ($table != null) {
      $this->table = $table;
    }

    return $this;
  }

  public function addBind ($bind) {
    $this->binds[] = $bind;
    return $this;
  }

  public function select ($select) {
    $this->select = $select;
    return $this;
  }

  public function join ($table, $column, $value) {
    return $this->innerJoin($table, $column, $value);
  }

  public function innerJoin ($table, $column, $value) {
    $this->joins['inner'][] = [$table, $column, $value];
    return $this;
  }

  public function outerJoin ($table, $column, $value) {
    $this->joins['outer'][] = [$table, $column, $value];
    return $this;
  }

  public function leftJoin ($table, $column, $value) {
    $this->joins['left'][] = [$table, $column, $value];
    return $this;
  }

  public function rightJoin ($table, $column, $value) {
    $this->joins['right'][] = [$table, $column, $value];
    return $this;
  }

  public function orderBy ($column, $order = 'DESC') {
    $this->orderBy = [$column, $order];
    return $this;
  }

  public function groupBy ($group, $order = 'DESC') {
    $this->groupBy = [$group, $order];
    return $this;
  }

  public function where ($column, $compare, $value = null) {
    if ($value == null) {
      $this->where = [$column, '=', $compare];
    } else {
      $this->where = [$column, $compare, $value];
    }
    return $this;
  }

  public function whereIn ($column, $values) {
    $valueString = "(";
    foreach ($values as $value) {
      $valueString .= "'$value', ";
    }
    $valueString = substr($valueString, 0, -2);
    $valueString .= ")";

    $this->where = [$column, 'IN', $values];

    return $this;
  }

  public function delete ($where = null) {
    $this->type = 'delete';
    if ($where != null) {
      if (count($where) == 2) {
        $this->where = [$where[0], '=', $where[1]];
      } else {
        $this->where = [$where[0], $where[1], $where[2]];
      }
    }
    return $this;
  }

  public function update (Array $fields, $where = null) {
    $this->type = 'update';
    $this->fields = $fields;

    if ($where != null) {
      if (count($where) == 2) {
        $this->where = [$where[0], '=', $where[1]];
      } else {
        $this->where = [$where[0], $where[1], $where[2]];
      }
    }
    
    return $this;
  }

  public function exec () {
    switch ($this->type) {
      case 'update':
        return QueryBuilder::execUpdate($this);
        break;
      case 'insert':
        return QueryBuilder::execInsert($this);
        break;
      case 'select':
        return QueryBuilder::execSelect($this);
        break;
      case 'delete':
        return QueryBuilder::execDelete($this);
        break;
      default:
        return QueryBuilder::execSelect($this);
        break;
    }
  }

  public function insert (Array $fields) {
    $this->type = 'insert';
    $this->fields = $fields;

    return $this;
  }

  public function get () {
    $this->type = 'select';
    
    if (!$this->select) {
      $this->select = "*";
    }

    return $this;
  }

}
