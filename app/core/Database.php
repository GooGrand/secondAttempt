<?php

    $configSet = require 'config.php';
    Database::connect($configSet['host'], $configSet['dbName'], $configSet['user'], $configSet['pass']);
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

    public static function queryOne($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetch();
    }

    public static function queryAll($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->fetchAll();
    }
    public static function querySingle($query, $params = array())
    {
        $result = self::queryOne($query, $params);
        if (!$result)
            return false;
        return $result[0];
    }

    // Executes a query and returns the number of affected rows
    public static function query($query, $params = array())
    {
        $result = self::$connection->prepare($query);
        $result->execute($params);
        return $result->rowCount();
    }
    public static function insert($table, $params = array())
    {
        return self::query("INSERT INTO `$table` (`".
            implode('`, `', array_keys($params)).
            "`) VALUES (".str_repeat('?,', sizeof($params)-1)."?)",
            array_values($params));
    }

    public static function update($table, $values = array(), $condition, $params = array())
    {
        return self::query("UPDATE `$table` SET `".
            implode('` = ?, `', array_keys($values)).
            "` = ? " . $condition,
            array_merge(array_values($values), $params));
    }
}