<?php


class Model
{
    private static $connection;

    protected $conn;
    protected $stats;
    protected $emode;
    protected $exname;

    function __construct()
    {
        $configSet = require 'config.php';
        self::$connection = Database::connect($configSet['host'], $configSet['dbName'], $configSet['user'], $configSet['pass']);
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
    public function getUser($user_id)
    {
        return Db::queryOne('
                        SELECT `user_id`, `name`, `surname`, `email`, `birthday`
                        FROM `users`
                        WHERE `user_id` = ?
                ', array($user_id));
    }


}