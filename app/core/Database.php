<?php

class Database
{
    private static $connection;

    public static function connect($host, $database, $user, $password)
    {
        if (empty(self::$connection)) {

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];

            $db = new PDO("mysql:host=$host;dbname=$database", $user, $password, $options);
            self::$connection= $db;
        }

        return self::$connection;
    }


}