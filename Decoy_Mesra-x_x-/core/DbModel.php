<?php

namespace app\core;

use app\core\QueryBuilder;


abstract class DbModel extends Model
{
    public abstract static function tableName(): string;

    public abstract function attributes(): array;

    public abstract function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).")
                    VALUES(".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        //var_dump($statement);
        //die();

        $statement->execute();
        //echo "hehe";
    }

    public function findPrimaryKeyByAttributes($attribut, $nilai)
{
    $tableName = $this->tableName();
    $primaryKey = $this->primaryKey();
    $attributes = array_filter($this->attributes(), fn($attr) => $attr !== $primaryKey);
    $attributes = array_filter($attributes, fn($attr) => $attr !== $attribut);
    $attributes = array_filter($attributes, fn($attr) => $attr !== $nilai);

    $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
    $sql = "SELECT $primaryKey FROM $tableName WHERE " . implode(' AND ', $params);
    $statement = self::prepare($sql);
                //var_dump($statement);
                //die();

    foreach ($attributes as $attribute) {
        $statement->bindValue(":$attribute", $this->{$attribute});
    }

    $statement->execute();
                //var_dump($statement->fetchColumn());
                //die();
    return $statement->fetchColumn();
}

    public function setNextPrimaryKey()
    {
        $primaryKey = $this->primaryKey();
        $tableName = $this->tableName();

        $sql = "SELECT MAX($primaryKey) FROM $tableName";
        $statement = self::prepare($sql);
        $statement->execute();

        $maxPrimaryKey = $statement->fetchColumn();
        $this->{$primaryKey} = $maxPrimaryKey + 1;
    }

    public function update()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
        $primaryKey = $this->primaryKey();
        $primaryKeyValue = $this->{$primaryKey};

        $sql = "UPDATE $tableName SET " . implode(', ', $params) . " WHERE $primaryKey = :primaryKey";
        $statement = self::prepare($sql);
        //var_dump($statement);
        //die();

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->bindValue(":primaryKey", $primaryKeyValue);

        $statement->execute();
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $query = new QueryBuilder($tableName, static::class);
        return $query->where($where);
    }

    public static function findAll($where = [])
    {
        $tableName = static::tableName();
        $query = new QueryBuilder($tableName, static::class);
        return $query->where($where);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}

?>
