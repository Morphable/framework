<?php
namespace Morphable\Database\Migrations;

require 'Field.php';

class Table {

  public $type = 'InnoDB';
  public $fields = [];
  public $name;
  private $query;
  private $primaryKey = false;

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

  public function setQuery () {
    $sql = 'CREATE TABLE `' . $this->name . '`( ';

    foreach ($this->fields as $key => $value) {
      $field = $value;
      if ($field->predefined != false) {
        $sql .= $this->predefinedFields($field->predefined);
      } else {
        $field->setSql();
        $sql .= $field->getSql();
      }
      $sql .= ($key === count($this->fields) -1 ? '' : ', ');
      
    }
    $sql .= ')' . 'ENGINE=' . $this->type . ' DEFAULT CHARSET=latin1;';
    $this->query = preg_replace('!\s+!', ' ', $sql);
  }

  public function drop ($connection) {
    $query = '
      DROP TABLE ' . $this->name . ';
    ';

    $connection->exec($query);
    return 'Table successfully dropped';
  }

  public function create ($connection) {
    $connection->exec($this->query);
    return 'Query successfully executed!';
  }

  public function setType ($type) {
    $this->type = $type;
    return $this;
  }

}
