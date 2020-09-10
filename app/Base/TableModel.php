<?php

namespace Base;

use PDO;

abstract class TableModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getFields()
    {
        $table_columns = self::$conn->query("PRAGMA table_info (".$this->table.")");

        foreach ($table_columns as $column) {
            $this->fields[$column['name']]['primary'] = $column['pk'] == 1 ? 1 : 0;

            if (!empty($column['dflt_value'])) {
                $this->fields[$column['name']]['value'] = $column['dflt_value'];
            } elseif (!preg_match("/^(bigint|integer|int|double|real|decimal|numeric)/i", $column['type'])) {
                $this->fields[$column['name']]['value'] = "";
            } else {
                $this->fields[$column['name']]['value'] = 0;
            }

            $this->fields[$column['name']]['type'] = !preg_match("/^(bigint|integer|int|double|real|decimal|numeric)/i", $column['type']) ? PDO::PARAM_STR : PDO::PARAM_INT;
        }

        return;
    }

    protected function fill($id)
    {
        reset($this->fields);
        $idName = key($this->fields);
        $query = "SELECT c.* FROM {$this->table} c WHERE $idName = :id";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(":id", $id, PDO::PARAM_INT);
        self::$stmt->execute();
        $dbField = self::$stmt->fetch(PDO::FETCH_OBJ);

        if (empty($dbField)) {
            return false;
        }

        foreach ($dbField as $key => $value) {
            $this->$key = $value;
        }

        return $this;
    }

    public function __set($field, $value)
    {
        $this->fields[$field]['value'] = $value;

        return $this;
    }

    public function __get($field)
    {
        if (array_key_exists($field, $this->fields)) {
            return $this->fields[$field]['value'];
        }

        return null;
    }
}