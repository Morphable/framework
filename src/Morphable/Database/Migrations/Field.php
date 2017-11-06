<?php

namespace Morphable\Database\Migrations;

class Field {

  public $isPrimary = false;
  public $isAutoincrement = false;
  public $isIndex = false; 

  public $fieldName;
  public $fieldType;
  public $fieldLength;
  public $fieldDefault;

  public $fieldAttribute;

  public $isUnsigned = false;
  public $isNullable = false;

  public $onFieldUpdate = 'restrict';
  public $onFieldDelete = 'restrict';

  function __construct ($name, $type) {
    $this->fieldName = $name;
    $this->fieldType = $type;
  }

  public function attribute ($attribute) {
    $this->fieldAttribute = $attribute;
    return $this;
  }

  public function nullable () {
    $this->isNullable = true;
    return $this;
  }

  public function primary () {
    $this->isPrimary = true;
    return $this;
  }

  public function index () {
    $this->isIndex = true;
    return $this;
  }

  public function autoincrement () {
    $this->isAutoincrement = true;
    return $this;
  }

  public function unsigned () {
    $this->isUnSigned = true;
    return $this;
  }

  public function default ($default) {
    $this->fieldDefault = $default;
    return $this;
  }

  public function length ($length) {
    $this->fieldLength = $length;
    return $this;
  }

  public function onUpdate ($type) {
    $this->onFieldUpdate = $type;
    return $this;
  }

  public function onDelete ($type) {
    $this->onFieldDelete = $type;
    return $this;
  }

  public function getName () {
    return $this->fieldName;
  }

  public function getType () {
    return $this->fieldType;
  }

  public function getLength () {
    return $this->fieldLength;
  }

  public function getDefault () {
    return $this->fieldDefault;
  }

  public function getAttribute () {
    return $this->fieldAttribute;
  }

  public function getPrimary () {
    return $this->isPrimary;
  }

  public function getIndex () {
    return $this->isindex;
  }

  public function getAutoincrement () {
    return $this->isAutoincrement;
  }

  public function getUnsigned () {
    return $this->isUnsigned;
  }

  public function getNullable () {
    return $this->isNullable;
  }

  public function getOnUpdate () {
    return $this->onFieldUpdate;
  }

  public function getOnDelete () {
    return $this->onFieldDelete;
  }
}
