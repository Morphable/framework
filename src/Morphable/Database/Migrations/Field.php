<?php

namespace Morphable\Database\Migrations;

class Field extends FieldTypes {

  private $table;
  public $type;
  public $name;
  public $isNullable = false;
  public $isUnSigned = false;
  public $hasDefault = false;
  public $length = false;
  
  public $primaryKey = false;

  public $foreignKey = false;
  public $_onUpdate = 'cascade';
  public $_onDelete = 'cascade';
  
  public $sql = '';
  public $predefined = false;
  
  function __construct ($table) {
    $this->table = $table;
    array_push($this->table->fields, $this);
  }

  public function setSql () {
    // name
    $this->sql .= '`' . $this->name . '`' . ' ';
    // type
    $this->sql .= $this->type . ($this->length != false ? '(' . $this->length . ')' : '') . ' '; 
    // unsigned
    $this->sql .= ($this->isUnSigned ? 'UNSIGNED' : '') . ' ';
    // null
    $this->sql .= (!$this->isNullable ? 'NOT NULL' : '') . ' ';
    // default
    $this->sql .= ($this->hasDefault != false || is_numeric($this->hasDefault) != false ? 'DEFAULT \'' . $this->hasDefault . '\'' : '') . ' ';
    // auto increment
    $this->sql .= ($this->autoIncrement ? 'AUTO_INCREMENT ' : '');

    return $this;
  }

  public function getSql () {
    return $this->sql;
  }
  
  public function newField ($name, $type, $primaryKey = false) {
    $field = new Field($this->table);
    $field->autoIncrement = $primaryKey;
    $field->name = $name;
    $field->type = $type;
    return $field;
  }

  public function isId ($name, $auto) {
    return $this->newField($name, 'int', $auto)->unsigned()->setLength(11);
  }

  public function setPrimaryKey () {
    $this->primaryKey = true;
    return $this;
  }

  public function foreign ($column, $on, $foreign) {
    $this->foreignKey = [$column, $on, $foreign];
    // array_push($this->table->foreignKeys, $this);
    return $this;
  }

  public function onUpdate ($type) {
    $this->_onUpdate = $type;
    return $this;
  }

  public function onDelete ($type) {
    $this->_onDelete = $type;
    return $this;
  }

  public function setType($type, $name) {
    return $this->newField($name, $type);
  }

  public function updatedAt ($name) {
    return $this->newField($name, 'updated_at')->usePredefined('updated_at');
  }

  public function createdAt ($name) {
    return $this->newField($name, 'created_at')->usePredefined('created_at');
  }

  public function isActive ($name) {
    return $this->newField($name, 'is_active')->usePredefined('is_active');
  }

  public function usePredefined ($name) {
    $this->predefined = $name;
    return $this;
  }

  public function setLength ($length) {
    $this->length = $length;
    return $this;
  }

  public function nullable () {
    $this->isNullable = true;
    return $this;
  }

  public function unsigned () {
    $this->isUnSigned = true;
    return $this;
  }

  public function default ($default) {
    $this->hasDefault = $default;
    return $this;
  }

}
