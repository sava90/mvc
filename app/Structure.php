<?php

use Base\Model;

class Structure extends Model
{
    public function createStructure()
    {
        $query = "CREATE TABLE IF NOT EXISTS users (
                    userId INTEGER PRIMARY KEY AUTOINCREMENT,
                    createDate DATETIME,
                    active BOOLEAN DEFAULT (0),
                    email VARCHAR (255) UNIQUE NOT NULL,
                    firstName VARCHAR (255) DEFAULT (''),
                    lastName VARCHAR (255) DEFAULT (''),                    
                    password CHAR (60) NOT NULL,
                    subscribe BOOLEAN DEFAULT (1),
                    verifyKey CHAR (40) DEFAULT (''));";
        self::$conn->exec($query);

        return;
    }
}
