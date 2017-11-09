<?php

namespace Morphable\Database\Migrations;

class Field {
  /**
   * @var boolean
   */
  public $isPrimary = false;

  /**
   * @var boolean
   */
  public $isAutoincrement = false;
  
  /**
   * @var boolean
   */
  public $isIndex = false; 

  /**
   * @var string
   */
  public $fieldName;

  /**
   * @var string
   */
  public $fieldType;

  /**
   * @var integer
   */
  public $fieldLength;
  
  /**
   * @var string
   */
  public $fieldDefault;

  /**
   * @var string
   */
  public $fieldAttribute;

  /**
   * @var boolean
   */
  public $isUnsigned = false;
  
  /**
   * @var boolean
   */
  public $isNullable = false;

  /**
   * @var string
   */
  public $onFieldUpdate = 'cascade';

  /**
   * @var string
   */
  public $onFieldDelete = 'cascade';

  /**
   * Constructor
   * @param string name
   * @param string type
   * @return void
   */
  function __construct ($name, $type) {
    $this->fieldName = $name;
    $this->fieldType = $type;
  }

  /**
   * Set attribute
   * @param string attribute
   * @return self
   */
  public function attribute ($attribute) {
    $this->fieldAttribute = $attribute;
    return $this;
  }

  /**
   * Set nullable
   * @return self
   */
  public function nullable () {
    $this->isNullable = true;
    return $this;
  }

  /**
   * Set isPrimary
   * @return self
   */
  public function primary () {
    $this->isPrimary = true;
    return $this;
  }

  /**
   * Set isIndex
   * @return self
   */
  public function index () {
    $this->isIndex = true;
    return $this;
  }

  /**
   * Set autoincrement
   * @return self
   */
  public function autoincrement () {
    $this->isAutoincrement = true;
    return $this;
  }

  /**
   * Set unsigned
   * @return self
   */
  public function unsigned () {
    $this->isUnSigned = true;
    return $this;
  }

  /**
   * Set default
   * @param string default
   * @return self
   */
  public function default ($default) {
    $this->fieldDefault = $default;
    return $this;
  }

  /**
   * Set length
   * @param integer $length
   * @return self
   */
  public function length ($length) {
    $this->fieldLength = $length;
    return $this;
  }

  /**
   * Set onUpdate
   * @param string type
   * @return self
   */
  public function onUpdate ($type) {
    $this->onFieldUpdate = $type;
    return $this;
  }

  /**
   * Set onDelete
   * @param string type
   * @return self
   */
  public function onDelete ($type) {
    $this->onFieldDelete = $type;
    return $this;
  }

  /**
   * Get name
   * @return string
   */
  public function getName () {
    return $this->fieldName;
  }

  /**
   * Get type
   * @return string
   */
  public function getType () {
    return $this->fieldType;
  }

  /**
   * Get length
   * @return integer
   */
  public function getLength () {
    return $this->fieldLength;
  }

  /**
   * Get default
   * @return string
   */
  public function getDefault () {
    return $this->fieldDefault;
  }

  /**
   * Get attribute
   * @return string
   */
  public function getAttribute () {
    return $this->fieldAttribute;
  }

  /**
   * Get primary
   * @return boolean
   */
  public function getPrimary () {
    return $this->isPrimary;
  }

  /**
   * Get index
   * @return boolean
   */
  public function getIndex () {
    return $this->isindex;
  }

  /**
   * Get autoincrement
   * @return boolean
   */
  public function getAutoincrement () {
    return $this->isAutoincrement;
  }

  /**
   * Get unsigned
   * @return boolean
   */
  public function getUnsigned () {
    return $this->isUnsigned;
  }

  /**
   * Get nullable
   * @return boolean
   */
  public function getNullable () {
    return $this->isNullable;
  }

  /**
   * Get onUpdate
   * @return string
   */
  public function getOnUpdate () {
    return $this->onFieldUpdate;
  }

  /**
   * Get onDelete
   * @return string
   */
  public function getOnDelete () {
    return $this->onFieldDelete;
  }
}
