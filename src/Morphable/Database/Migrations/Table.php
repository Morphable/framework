<?php

namespace Morphable\Database\Migrations;

class Table {

  /**
   * @var array
   */
  public $fields = [];

  /**
   * @var string
   */
  public $table;

  /**
   * @var string
   */
  public $prefix = '';

  /**
   * @var int
   */
  public $defaultStringLength = 255;

  /**
   * @var string
   */
  public $collation = 'utf8_unicode_ci';

  /**
   * @var string
   */
  public $engine = 'InnoDB';

  /**
   * @var string
   */
  public $charset = "utf8";

  /**
   * @var array
   */
  public $foreigns = [];

  /**
   * @var string
   */
  public $primaryKey;

  /**
   * @param $table: table name
   * @param $callback: execute callback
   * @return $this if callback is not null
   */
  function __construct ($table, $callback = null) {
    $this->table = $table;

    if ($callback != null) {
      $callback($this);
    }
  }

  /**
   * @param $index: foreign key
   * @param $table: reference table
   * @param $field: references id
   */
  public function foreign ($index, $table, $field) {
    $this->foreigns[] = [$index, $table, $field];
    return $this;
  }

  public function getForeignKeys () {
    return $this->foreigns;
  }

  /**
   * @return $table
   */
  public function getTable () {
    return $this->table;
  }

  /**
   * @return $engine
   */
  public function getEngine () {
    return $this->engine;
  }

  /**
   * @return $prefix
   */
  public function getPrefix () {
    return $this->prefix;
  }

  /**
   * @return $collation
   */
  public function getCollation () {
    return $this->collation;
  }

  /**
   * @return $charset
   */
  public function getCharset () {
    return $this->charset;
  }

  /**
   * @return $fields
   */
  public function getFields () {
    return $this->fields;
  }

  /**
   * Add a field to the table
   * @param $name: field name
   * @param $type: type of field
   * @param $predefined: field is predefined
   * @return new Field()
   */
  private function addField ($name, $type, $predefined = null) {
    $field = new Field($name, $type, $predefined);
    $this->fields[] = $field;
    return $field;
  }

  /**
   * Predefined created at field
   * @param $name: field name
   * @return new Field() with predefined createdAt
   */
  public function createdAt ($name = 'created_at') {
    return $this->addField($name, 'timestamp')->default('CURRENT_TIMESTAMP');
  }

  /**
   * Predefined updated at field
   * @param $name: field name
   * @return new Field() with predefined createdAt
   */
  public function updatedAt ($name = 'updated_at') {
    return $this->addField($name, 'timestamp')->attribute('on update CURRENT_TIMESTAMP');
  }

  /**
   * Predefined is active field
   * @param $name: field name
   * @return new Field() with predefined createdAt
   */
  public function isActive ($name = 'is_active') {
    return $this->addField($name, 'boolean')->default(1);
  }

  /**
   * Create a new primary key field
   * @param $name: field name
   * @return new Field()
   */
  public function primary ($name = 'id') {
    $this->primaryKey = $name;
    return $this->addField($name, 'int')->primary()->autoincrement()->unsigned()->length(11);
  }

  /**
   * Create a new index key field
   * @param $name: field name
   * @return new Field()
   */
  public function index ($name) {
    return $this->addField($name, 'int')->index()->unsigned()->length(11);
  }
  
  /**
   * Create a new Field with type integer
   * @param $name: field name
   * @return new Field()
   */
  public function int ($name) {
    return $this->addField($name, 'int');
  }

  /**
   * Create a new Field with type tiny int
   * @param $name: field name
   * @return new Field()
   */
  public function tinyint ($name) {
    return $this->addField($name, 'tinyint');
  }

  /**
   * Create a new Field with type small int
   * @param $name: field name
   * @return new Field()
   */
  public function smallint ($name) {
    return $this->addField($name, 'smallint');
  }

  /**
   * Create a new Field with type medium int
   * @param $name: field name
   * @return new Field()
   */
  public function mediumint ($name) {
    return $this->addField($name, 'mediumint');
  }

  /**
   * Create a new Field with type big int
   * @param $name: field name
   * @return new Field()
   */
  public function bigint ($name) {
    return $this->addField($name, 'bigint');
  }

  /**
   * Create a new Field with type decimal
   * @param $name: field name
   * @return new Field()
   */
  public function decimal ($name) {
    return $this->addField($name, 'decimal');
  }

  /**
   * Create a new Field with type float
   * @param $name: field name
   * @return new Field()
   */
  public function float ($name) {
    return $this->addField($name, 'float');
  }

  /**
   * Create a new Field with type double
   * @param $name: field name
   * @return new Field()
   */
  public function double ($name) {
    return $this->addField($name, 'double');
  }

  /**
   * Create a new Field with type real
   * @param $name: field name
   * @return new Field()
   */
  public function real ($name) {
    return $this->addField($name, 'real');
  }

  /**
   * Create a new Field with type bit
   * @param $name: field name
   * @return new Field()
   */
  public function bit ($name) {
    return $this->addField($name, 'bit');
  }

  /**
   * Create a new Field with type boolean
   * @param $name: field name
   * @return new Field()
   */
  public function boolean ($name) {
    return $this->addField($name, 'boolean');
  }

  /**
   * Create a new Field with type serial
   * @param $name: field name
   * @return new Field()
   */
  public function serial ($name) {
    return $this->addField($name, 'serial');
  }
  
  /**
   * Create a new Field with type char
   * @param $name: field name
   * @return new Field()
   */
  public function char ($name) {
    return $this->addField($name, 'char');
  }

  /**
   * Create a new Field with type varchar
   * @param $name: field name
   * @return new Field()
   */
  public function varchar ($name) {
    return $this->addField($name, 'varchar')->length($this->defaultStringLength);
  }

  /**
   * Create a new Field with type text
   * @param $name: field name
   * @return new Field()
   */
  public function text ($name) {
    return $this->addField($name, 'text');
  }

  /**
   * Create a new Field with type tiny text
   * @param $name: field name
   * @return new Field()
   */
  public function tinytext ($name) {
    return $this->addField($name, 'tinytext');
  }

  /**
   * Create a new Field with type medium text
   * @param $name: field name
   * @return new Field()
   */
  public function mediumtext ($name) {
    return $this->addField($name, 'mediumtext');
  }

  /**
   * Create a new Field with type long text
   * @param $name: field name
   * @return new Field()
   */
  public function longtext ($name) {
    return $this->addField($name, 'longtext');
  }
  
  /**
   * Create a new Field with type enum
   * @param $name: field name
   * @return new Field()
   */
  public function enum ($name) {
    return $this->addField($name, 'enum');
  }

  /**
   * Create a new Field with type date
   * @param $name: field name
   * @return new Field()
   */
  public function date ($name) {
    return $this->addField($name, 'date');
  }

  /**
   * Create a new Field with type date time
   * @param $name: field name
   * @return new Field()
   */
  public function datetime ($name) {
    return $this->addField($name, 'datetime');
  }

  /**
   * Create a new Field with type timestamp
   * @param $name: field name
   * @return new Field()
   */
  public function timestamp ($name) {
    return $this->addField($name, 'timestamp');
  }

  /**
   * Create a new Field with type time
   * @param $name: field name
   * @return new Field()
   */
  public function time ($name) {
    return $this->addField($name, 'time');
  }

  /**
   * Create a new Field with type year
   * @param $name: field name
   * @return new Field()
   */
  public function year ($name) {
    return $this->addField($name, 'year');
  }

}
