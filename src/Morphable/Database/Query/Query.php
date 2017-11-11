<?php

namespace Morphable\Database\Query;

use Exception;

class Query {
  
  /**
   * @param string
   */
  public $table;

  /**
   * @param string
   */
  public $type;
  /**
   * @param array
   */
  public $where;
  /**
   * @param array
   */
  public $orderBy;
  /**
   * @param array
   */
  public $groupBy;

  /**
   * @param string
   */
  public $select;

  /**
   * @param array
   */
  public $fields;

  /**
   * @param array
   */
  public $binds = [];

  /**
   * @param array
   */
  public $joins = [
    'inner' => [],
    'outer' => [],
    'left' => [],
    'right' => []
  ];

  /**
   * @param string
   */
  public $query;

  /**
   * Construct
   * @param string
   * @return self
   */
  function __construct ($table = null) {
    if ($table != null) {
      $this->table = $table;
    }

    return $this;
  }

  /**
   * Push into binds
   * @param string
   * @return self
   */
  public function addBind ($bind) {
    $this->binds[] = $bind;
    return $this;
  }

  /**
   * Set select
   * @param string
   * @return self
   */
  public function select ($select) {
    $this->select = $select;
    return $this;
  }

  /**
   * Add inner join
   * @param string table
   * @param string column
   * @param string value
   * @return self
   */
  public function join ($table, $column, $value) {
    return $this->innerJoin($table, $column, $value);
  }

  /**
   * Add inner join
   * @param string table
   * @param string column
   * @param string value
   * @return self
   */
  public function innerJoin ($table, $column, $value) {
    $this->joins['inner'][] = [$table, $column, $value];
    return $this;
  }

  /**
   * Add outer join
   * @param string table
   * @param string column
   * @param string value
   * @return self
   */
  public function outerJoin ($table, $column, $value) {
    $this->joins['outer'][] = [$table, $column, $value];
    return $this;
  }

  /**
   * Add left join
   * @param string table
   * @param string column
   * @param string value
   * @return self
   */
  public function leftJoin ($table, $column, $value) {
    $this->joins['left'][] = [$table, $column, $value];
    return $this;
  }

  /**
   * Add right join
   * @param string table
   * @param string column
   * @param string value
   * @return self
   */
  public function rightJoin ($table, $column, $value) {
    $this->joins['right'][] = [$table, $column, $value];
    return $this;
  }

  /**
   * Set orderby
   * @param string column
   * @param string order
   * @return self
   */
  public function orderBy ($column, $order = 'DESC') {
    $this->orderBy = [$column, $order];
    return $this;
  }

  /**
   * Set groupBy
   * @param string group
   * @param string order
   * @return self
   */
  public function groupBy ($group, $order = 'DESC') {
    $this->groupBy = [$group, $order];
    return $this;
  }

  /**
   * Set where
   * @param string column
   * @param string compare
   * @param string value
   * @return self
   */
  public function where ($column, $compare, $value = null) {
    if ($value == null) {
      $this->where = [$column, '=', $compare];
    } else {
      $this->where = [$column, $compare, $value];
    }
    return $this;
  }

  /**
   * Set whereIn
   * @param string column
   * @param string values
   * @return self
   */
  public function whereIn ($column, $values) {
    $this->where = [$column, 'IN', $values];
    return $this;
  }

  /**
   * Set type insert
   * @param string fields
   * @return self
   */
  public function insert (Array $fields) {
    $this->type = 'insert';
    $this->fields = $fields;

    return $this;
  }

  /**
   * Set type select
   * @return self
   */
  public function get () {
    $this->type = 'select';
    
    if (!$this->select) {
      $this->select = "*";
    }

    return $this;
  }

  /**
   * Set type delete
   * @param string where
   * @return self
   */
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

  /**
   * Set type update
   * @param string fields
   * @param string where
   * @return self
   */
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

  /**
   * Execute query
   * @return method
   */
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

}
