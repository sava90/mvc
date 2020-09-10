<?php

namespace Base;

abstract class Service
{
    protected static $instances = [];
    protected $model;

    protected function __construct()
    {
    }

    public static function getInstance()
    {
        $calledClass = get_called_class();

        if (!isset(self::$instances[$calledClass])) {
            self::$instances[$calledClass] = new $calledClass();
        }

        return self::$instances[$calledClass];
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function __get($field)
    {
        if ($this->model) {
            return $this->model->$field;
        }

        return null;
    }

    public function __set($field, $value)
    {
        $this->model->$field = $value;

        return $this;
    }
}