<?php

namespace Morphable\Database\Migrations;

class Field {

  private $table;
  public $type;
  public $name;
  public $isNullable = false;
  public $isUnSigned = false;
  public $hasDefault = false;
  public $length = false;
  public $predefined = false;
  public $autoIncrement = false;
  public $sql = '';

  function __construct ($table) {
    $this->table = $table;
    array_push($this->table->fields, $this);
  }

  public function setSql () {
    $this->sql .= '`' 
      . $this->name . '` ' // set name
      . $this->type . ($this->length != false ? '(' . $this->length . ')' : '') . ' ' // set type with length
      . ($this->isUnSigned ? 'UNSIGNED' : '') . ' ' // unsigned
      . (!$this->isNullable ? 'NOT NULL' : '') . ' '
      . ($this->hasDefault != false ? 'DEFAULT \'' . $this->hasDefault . '\'' : '') . ' '
      . ($this->autoIncrement ? 'AUTO_INCREMENT primary KEY' : '');
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

  public function primaryKey ($name) {
    return $this->newField($name, 'int', true)->unsigned();
  }

  public function varchar ($name) {
    return $this->newField($name, 'varchar')->setLength(255);
  }

  public function integer ($name) {
    return $this->newField($name, 'int');
  }

  public function boolean ($name) {
    return $this->newField($name, 'boolean');
  }

  public function date ($name) {
    return $this->newField($name, 'date');
  }

  public function timestamp ($name) {
    return $this->newField($name, 'timestamp');
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
