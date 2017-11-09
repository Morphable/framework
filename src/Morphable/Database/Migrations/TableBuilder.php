<?php

namespace Morphable\Database\Migrations;

class TableBuilder {

  /**
   * Build a set primary key sql string
   * @param string key
   * @return string
   */
  public static function buildPrimaryKey ($key) {
    return "primary key ({$key})";
  }
  
  /**
   * Build a set foreign key string
   * @param array foreign
   * @return string
   */
  public static function buildForeign ($foreign, $strict) {
    $index = $foreign[0];
    $foreignTbl= $foreign[1];
    $foreignKey = $foreign[2];

    $sql = "";
    $sql .= "CONSTRAINT `foreign_{$index}_{$foreignTbl}_{$foreignKey}`" . " ";
    $sql .= "FOREIGN KEY ({$index})";
    $sql .= ' REFERENCES ';
    $sql .= "{$foreignTbl}({$foreignKey})";
    if ($strict) {
      $sql .= ' ON UPDATE RESTRICT ';
      $sql .= ' ON DELETE RESTRICT ';
    } else {
      $sql .= ' ON UPDATE CASCADE ';
      $sql .= ' ON DELETE CASCADE ';
    }

    return $sql;
  }

  /**
   * Build a table field string
   * @param object field
   * @return string
   */
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

  /**
   * Check if table exists
   * @param object connection
   * @param string table
   * @return boolean
   */
  public static function tableExists ($connection, $table) {
    $sql = "SHOW TABLES LIKE '{$table}'";
    $stmt = $connection->query($sql);
    $count = $stmt->rowCount();

    if ($count > 0) {
      return true;
    }

    return false;
  }

  /**
   * Check if foreign key exists
   * @param object connection
   * @param string table
   * @param string constraint
   * @return boolean
   */
  public static function foreignKeyExists ($connection, $table, $constraint) {
    $dbName = $connection->query('SELECT database()')->fetchColumn();

    $sql = "
    SELECT * FROM information_schema.TABLE_CONSTRAINTS 
    WHERE information_schema.TABLE_CONSTRAINTS.CONSTRAINT_TYPE = 'FOREIGN KEY'
    AND information_schema.TABLE_CONSTRAINTS.TABLE_SCHEMA = '{$dbName}'
    AND information_schema.TABLE_CONSTRAINTS.TABLE_NAME = '{$table}' ";

    $stmt = $connection->query($sql);
    $result = $stmt->fetchAll();

    foreach($result as $column) {
      if ($column['CONSTRAINT_NAME'] == $constraint) {
        return true;
      }
    }

    return false;
  }
  /**
   * Execute the create table query
   * @param object connection
   * @param object object
   * @return boolean
   */
  public static function create ($connection, $object) {
    if (!self::tableExists($connection, $object->table)) {
      $build = self::build($object);
      $connection->query($build);
      return true;
    }

    return false;
  }

  /**
   * Execute a drop table query
   * @param object connection
   * @param string table
   * @return boolean
   */
  public static function drop ($connection, $table) {
    if (self::tableExists($connection, $table)) {
      $connection->query("
        DROP TABLE {$table}
      ");
      return true;
    }

    return false;
  }

  /**
   * Execute a drop foreign query
   * @param object connection
   * @param string table
   * @param string constraint
   */
  public static function dropForeignKey ($connection, $table, $constraint) {
    if (self::tableExists($connection, $table)) {
      if (self::foreignKeyExists($connection, $table, $constraint)) {
        $sql = "ALTER TABLE {$table} DROP FOREIGN KEY {$constraint}";
        $connection->query($sql);
        return true;
      }
      return false;
    }
    return false;
  }

  /**
   * Build the create table query
   * @param object table
   * @return string
   */
  public static function build (Table $table) {
    $sql = "";
    $sql .= "CREATE TABLE `{$table->getTable()}` (";
    $sql .= PHP_EOL;

    foreach ($table->getFields() as $field) {

      $sql .= self::buildField($field);
      $sql .= ',';
      $sql .= PHP_EOL;
    }

    foreach ($table->getForeignKeys() as $foreign) {
      $sql .= self::buildForeign($foreign, $table->strict);
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
