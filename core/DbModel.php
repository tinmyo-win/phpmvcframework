<?php

namespace app\core;

use app\models\Model;

abstract class DbModel extends Model
{
  abstract public function tableName(): string;

  abstract public function attributes(): array;

  abstract public function primaryKey(): string;

  public function save() {
    $tableName = $this->tableName();
    $attributes = $this->attributes();
    $params = array_map(function($attr) { return ":$attr"; }, $attributes);

    $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).")  VALUES (".implode(',', $params).")");

    foreach($attributes as $attribute) {
      $statement->bindValue(":$attribute", $this->{$attribute});
    }

    $statement->execute();
    
    return true;
    
  }

  public static function findOne($where) {
    $tableName = static::tableName();
    $attributes = array_keys($where);
    $sql = implode("AND " , array_map(function($attr) { return "$attr = :$attr"; }, $attributes));

    $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

    foreach($where as $key => $item) {
      $statement->bindValue(":$key", $item);
    }

    $statement->execute();
    return $statement->fetchObject(static::class);
  }

  public static function prepare($sql) {
    return Application::$app->db->pdo->prepare($sql);
  }
}