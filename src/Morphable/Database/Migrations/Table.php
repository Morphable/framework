<?php

namespace Morphable\Database\Migrations;
use Morphable\Database;

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
   * @var object
   */
  private $connection;

  /**
   * Constructor
   * @param object connection
   * @param string table
   * @param function callback 
   * @return $this if callback is not null
   */
  function __construct ($connection, $table, $callback = null) {
    $this->connection = $connection;
    $this->table = $table;

    if ($callback != null) {
      $callback($this);
    }
  }

  /**
   * Drop a table
   * @return function
   */
  public function drop () {
    return TableBuilder::drop($this->connection, $this->table);
  }

  /**
   * Drop a foreign key
   * @param string constraint
   * @return function
   */
  public function dropForeignKey ($constraint) {
    return TableBuilder::dropForeignKey($this->connection, $this->table, $constraint);
  }
  
  /**
   * Create a table
   * @return function
   */
  public function create () {
    return TableBuilder::create($this->connection, $this);
  } 

  /**
   * Add a foreign key
   * @param string $index
   * @param string $table
   * @param string $field
   * @return self
   */
  public function foreign ($index, $table, $field) {
    $this->foreigns[] = [$index, $table, $field];
    return $this;
  }

  /**
   * Get foreign keys
   * @return array<array<string>>
   */
  public function getForeignKeys () {
    return $this->foreigns;
  }

  /**
   * Get table
   * @return string
   */
  public function getTable () {
    return $this->table;
  }

  /**
   * Get engine
   * @return string
   */
  public function getEngine () {
    return $this->engine;
  }

  /**
   * Get preifx
   * @return string
   */
  public function getPrefix () {
    return $this->prefix;
  }

  /**
   * Get collation
   * @return string
   */
  public function getCollation () {
    return $this->collation;
  }

  /**
   * Get charset
   * @return string
   */
  public function getCharset () {
    return $this->charset;
  }

  /**
   * Get fields
   * @return array<object>
   */
  public function getFields () {
    return $this->fields;
  }

  /**
   * Add a field to the table
   * @param string name
   * @param string type
   * @return object
   */
  private function addField ($name, $type) {
    $field = new Field($name, $type);
    $this->fields[] = $field;
    return $field;
  }

  /**
   * Predefined created at field
   * @param $name: field name
   * @return self
   */
  public function createdAt ($name = 'created_at') {
    return $this->addField($name, 'timestamp')->default('CURRENT_TIMESTAMP');
  }

  /**
   * Predefined updated at field
   * @param string name
   * @return self
   */
  public function updatedAt ($name = 'updated_at') {
    return $this->addField($name, 'timestamp')->attribute('on update CURRENT_TIMESTAMP');
  }

  /**
   * Predefined is active field
   * @param string name
   * @return self
   */
  public function isActive ($name = 'is_active') {
    return $this->addField($name, 'boolean')->default(1);
  }

  /**
   * Create a new primary key field
   * @param string name
   * @return self
   */
  public function primary ($name = 'id') {
    $this->primaryKey = $name;
    return $this->addField($name, 'int')->primary()->autoincrement()->unsigned()->length(11);
  }

  /**
   * Create a new index key field
   * @param string name
   * @return self
   */
  public function index ($name) {
    return $this->addField($name, 'int')->index()->unsigned()->length(11);
  }
  
  /**
   * Create a new Field with type integer
   * @param string name
   * @return self
   */
  public function int ($name) {
    return $this->addField($name, 'int');
  }

  /**
   * Create a new Field with type tiny int
   * @param string name
   * @return self
   */
  public function tinyint ($name) {
    return $this->addField($name, 'tinyint');
  }

  /**
   * Create a new Field with type small int
   * @param string name
   * @return self
   */
  public function smallint ($name) {
    return $this->addField($name, 'smallint');
  }

  /**
   * Create a new Field with type medium int
   * @param string name
   * @return self
   */
  public function mediumint ($name) {
    return $this->addField($name, 'mediumint');
  }

  /**
   * Create a new Field with type big int
   * @param string name
   * @return self
   */
  public function bigint ($name) {
    return $this->addField($name, 'bigint');
  }

  /**
   * Create a new Field with type decimal
   * @param string name
   * @return self
   */
  public function decimal ($name) {
    return $this->addField($name, 'decimal');
  }

  /**
   * Create a new Field with type float
   * @param string name
   * @return self
   */
  public function float ($name) {
    return $this->addField($name, 'float');
  }

  /**
   * Create a new Field with type double
   * @param string name
   * @return self
   */
  public function double ($name) {
    return $this->addField($name, 'double');
  }

  /**
   * Create a new Field with type real
   * @param string name
   * @return self
   */
  public function real ($name) {
    return $this->addField($name, 'real');
  }

  /**
   * Create a new Field with type bit
   * @param string name
   * @return self
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
