<?php
namespace Morphable\Database\Migrations;
use PDO;

require 'Field.php';

class Table {

  public $type = 'InnoDB';
  public $fields = [];
  public $name;
  public $query;
  public $primaryKey = false;
  public $foreignKeys = [];

  function __construct($name, $fields) {
    $this->name = $name;
    $fields(new Field($this));
    array_splice($this->fields, 0, 1);
  }

  public function predefinedFields ($case, $name = false) {
    switch ($case) {
      case 'updated_at':
        return '`' . ($name != false ? $name : 'updated_at') . '` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP';
        break;
      case 'created_at':
        return '`' . ($name != false ? $name : 'created_at') . '` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP';
        break;
      case 'is_active':
        return '`' . ($name != false ? $name : 'is_active') . '` tinyint(1) NOT NULL DEFAULT \'1\'';
        break;
      default:
        return false;
        break;
    }
  }

  public function getQuery () {
    $sql = 'CREATE TABLE `' . $this->name . '`( ';

    foreach ($this->fields as $key => $value) {
      $field = $value;
      if ($field->primaryKey) $this->primaryKey = $field;
      if ($field->foreignKey != false) array_push($this->foreignKeys, $field);

      if ($field->predefined != false) {
        $sql .= $this->predefinedFields($field->predefined);
      } else {
        $field->setSql();
        $sql .= $field->getSql();
      }
      $sql .= ', ';
      
    }

    $sql .= 'primary key (' . $this->primaryKey->name . '),';

    if (count($this->foreignKeys) > 0) {
      foreach($this->foreignKeys as $foreignField) {
        $sql .= 'CONSTRAINT `foreign_' . $this->name . '_' . $foreignField->foreignKey[0] . '_' . $foreignField->foreignKey[2] . '` ';
        $sql .= 'FOREIGN KEY (' . $foreignField->foreignKey[0] . ')';
        $sql .= ' REFERENCES ';
        $sql .= $foreignField->foreignKey[1] .'('.$foreignField->foreignKey[2].') ';
        $sql .= ' ON DELETE ' . strtoupper($foreignField->_onDelete) . ' ON UPDATE ' . strtoupper($foreignField->_onDelete) . ',';
      }
    }

    $sql = substr($sql, 0, -1);

    $sql .= ')' . 'ENGINE=' . $this->type . ' DEFAULT CHARSET=latin1;';
    $this->query = preg_replace('!\s+!', ' ', $sql);

    return $sql;
  }

  public function dropKey ($connection, $constraint) {
    $sql = 'alter table ' . $this->name . ' drop foreign key ' . $constraint;
    if ($this->tableExists($connection, $this->name)) {
      if ($this->foreignExists($connection, $constraint)) {
        $connection->query($sql);
        return 'key is dropped';
      }
      return 'foreign key does not exist';
    }
    return 'table does not exists';
  }

  public function foreignExists ($connection, $constraint) {

    $dbName = $connection->query('SELECT database()')->fetchColumn();

    $sql = '
    SELECT * FROM information_schema.TABLE_CONSTRAINTS 
    WHERE information_schema.TABLE_CONSTRAINTS.CONSTRAINT_TYPE = \'FOREIGN KEY\'
    AND information_schema.TABLE_CONSTRAINTS.TABLE_SCHEMA = \'' . $dbName . '\'
    AND information_schema.TABLE_CONSTRAINTS.TABLE_NAME = \''. $this->name .'\';';

    $stmt = $connection->query($sql);
    $result = $stmt->fetchAll();

    foreach($result as $column) {
      if ($column['CONSTRAINT_NAME'] == $constraint) {
        return true;
      }
    }

    return false;
  }

  public function tableExists ($connection, $table) {
    $sql = 'SHOW TABLES LIKE \'' . $this->name . '\'';
    $stmt = $connection->query($sql);
    $count = $stmt->rowCount();

    if ($count > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function drop ($connection) {
    $drop = 'DROP TABLE ' . $this->name;

    if ($this->tableExists($connection, $this->name)) {
      $connection->exec($drop);
      return 'Table successfully dropped';
    } else {
      return 'Table does not exists';
    }

  }

  public function create ($connection) {
    $connection->exec($this->getQuery());
    return 'Query successfully executed!';
  }

  public function setType ($type) {
    $this->type = $type;
    return $this;
  }

}
