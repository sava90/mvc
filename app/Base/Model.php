<?php

namespace Base;

use PDO;
use Structure;

abstract class Model
{
    static protected $conn = null;
    static protected $stmt = null;
    protected $table = '';
    protected $fields = [];
    protected $usersTable = 'users';

    public function __construct()
    {
        if (self::$conn != null) {
            return;
        }

        try {
            self::$conn = new PDO('sqlite:'.__DIR__.'/../../db/database.db');
            self::$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            (new Structure())->createStructure();
        } catch (\PDOException $exc) {
            die($exc->getMessage());
        }
    }

    public function __destruct()
    {
    }
}

