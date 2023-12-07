<?php

namespace app\core;

class QueryBuilder
{
    protected $selects = [];
    protected $joins = [];
    protected $conditions = [];
    protected $table = [];
    protected $object;

    public function __construct($table, $object)
    {
        $this->table = $table;
        $this->object = $object;
    }

    public function where($conditions)
    {
        $this->conditions = $conditions;
        return $this;
    }

    public function join($table, $condition)
    {
        $this->joins[] = "JOIN $table ON $condition";
        return $this;
    }

    public function getSql()
    {
        // Build the SQL query
        $sql = "SELECT * FROM {$this->table} ";
        if (!empty($this->joins)) {
            $sql .= implode(' ', $this->joins) . ' ';
        }

        if (!empty($this->conditions)) {
          $conditionStrings = [];
          foreach ($this->conditions as $column => $value) {
              $conditionStrings[] = "$column = :$column";
          }
          $sql .= " WHERE " . implode(' AND ', $conditionStrings);
        }
        return $sql;
    }

    public function get()
    {
        $sql = $this->getSql();
        $statement = Application::$app->db->pdo->prepare($sql);

        // Bind values if there are conditions
        if (!empty($this->conditions)) {
          foreach ($this->conditions as $key => $value) {
              $statement->bindValue(":$key", $value);
          }
        }


        $statement->execute();
        return $statement->fetchObject($this->object);
    }
}

?>
