<?php

namespace Morphable\Database\Migrations;

class TableBuilder {

  function __constructor () {

  }

  public static function buildPrimaryKey ($key) {
    return "primary key ({$key})";
  }

  public static function buildForeign ($foreign) {
    $index = $foreign[0];
    $foreignTbl= $foreign[1];
    $foreignKey = $foreign[2];

    $sql = "";
    $sql .= "CONSTRAINT `foreign_{$index}_{$foreignTbl}_{$foreignKey}`" . " ";
    $sql .= "FOREIGN KEY ({$index})";
    $sql .= ' REFERENCES ';
    $sql .= "{$foreignTbl}({$foreignKey})";

    return $sql;
  }

  public static function buildField (Field $field) {
    $sql = "";
    $sql .= "`{$field->getName()}` ";

    $sql .= "{$field->getType()}" . (!empty($field->getLength()) ? "({$field->getLength()})" : "") . "";

    $sql .= ($field->getUnsigned() ? "UNSIGNED" : "") . " ";

    $sql .= (!$field->getNullable() ? "NOT NULL" : "") . " ";

    $sql .= (!empty($field->getDefault()) || is_numeric($field->getDefault()) ? "DEFAULT {$field->getDefault()}" : "") . " ";

    $sql .= " {$field->getAttribute()} ";

    $sql .= ($field->getAutoincrement() ? "AUTO_INCREMENT" : "");

    return $sql;
  }

  public static function build (Table $table) {
    $sql = "";
    $sql .= "CREATE TABLE `{$table->getPrefix()}{$table->getTable()}` (";
    $sql .= PHP_EOL;

    foreach ($table->getFields() as $field) {
      $sql .= self::buildField($field);
      $sql .= ',';
      $sql .= PHP_EOL;
    }

    
    foreach ($table->getForeignKeys() as $foreign) {
      $sql .= self::buildForeign($foreign);
      $sql .= ",";
      $sql .= PHP_EOL;
    }
    $sql = substr($sql, 0, -1);
    $sql .= self::buildPrimaryKey($table->primaryKey);
    $sql .= PHP_EOL;
    $sql .= ") ENGINE={$table->getEngine()} DEFAULT CHARSET={$table->getCharset()};";

    return $sql;
  }

}
