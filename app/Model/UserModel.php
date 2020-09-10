<?php
namespace Model;

use PDO;
use Base\TableModel;

class UserModel extends TableModel
{
    public function __construct($userId)
    {
        parent::__construct();
        $this->table = $this->usersTable;

        $this->getFields();
        if ($userId != 0) {
            $this->fill($userId);
        }
    }

    public function getUsers()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY userId DESC";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->execute();
        $dbFields = self::$stmt->fetchAll(PDO::FETCH_OBJ);

        return $dbFields;
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':email', $email, PDO::PARAM_STR);
        self::$stmt->execute();
        $dbField = self::$stmt->fetch(PDO::FETCH_OBJ);

        return $dbField;
    }

    public function createAccount($email, $password, $date, $verifyKey)
    {
        $query = "INSERT INTO {$this->table} (createDate, email, password, verifyKey) VALUES (:createDate, :email, :password, :verifyKey)";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':createDate', $date, PDO::PARAM_STR);
        self::$stmt->bindParam(':email', $email, PDO::PARAM_STR);
        self::$stmt->bindParam(':password', $password, PDO::PARAM_STR);
        self::$stmt->bindParam(':verifyKey', $verifyKey, PDO::PARAM_STR);
        self::$stmt->execute();

        return self::$conn->lastInsertId();
    }

    public function checkDuplicateEmail($email)
    {
        $query = "SELECT userId FROM {$this->table} WHERE email = :email";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':email', $email, PDO::PARAM_STR);
        self::$stmt->execute();
        $dbField = self::$stmt->fetch(PDO::FETCH_OBJ);

        return $dbField ? true : false;
    }

    public function verifyAccount($userId)
    {
        $query = "UPDATE {$this->table} SET active = 1, verifyKey = '' WHERE userId = :userId";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        self::$stmt->execute();
        $errorCode = (int)self::$conn->errorCode();

        return $errorCode ? false : true;
    }

    public function updateSettings($userId, $firstName, $lastName, $subscribe)
    {
        $query = "UPDATE {$this->table} SET firstName = :firstName, lastName = :lastName, subscribe = :subscribe WHERE userId = :userId";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        self::$stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        self::$stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        self::$stmt->bindParam(':subscribe', $subscribe, PDO::PARAM_INT);
        self::$stmt->execute();
        $errorCode = (int)self::$conn->errorCode();

        return $errorCode ? false : true;
    }
}
