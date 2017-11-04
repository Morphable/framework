<?php

namespace Morphable\Database\Migrations;

class FieldTypes {

  function __constructor () {}

  public function newField ($name, $type, $primaryKey = false) {
    $field = new Field($this->table);
    $field->autoIncrement = $primaryKey;
    $field->name = $name;
    $field->type = $type;
    return $field;
  }

  public function index ($name) {
    return $this->isId($name, false);
  }

  public function autoIncrement ($name) {
    return $this->isId($name, true)->setPrimaryKey();
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

  public function text ($name) {
    return $this->newField($name, 'text');
  }

  public function tinyInt ($name) {
    return $this->newField($name, 'tinyint')->setLength(1);
  }

  public function decimal ($name) {
    return $this->newField($name, 'decimal');
  }

  public function date ($name) {
    return $this->newField($name, 'date');
  }

  public function timestamp ($name) {
    return $this->newField($name, 'timestamp');
  }

}
