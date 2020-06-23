<?php


class Model
{
    private static $connection;

    function __construct()
    {
        self::$connection = Database::connect(HOST, DBNAME, USER, PASS);
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
    public static function getPageForPg ($query, $limit, $offset)
    {
        $result = self::$connection->prepare($query);
        $result->bindValue(1, $limit, PDO::PARAM_INT);
        $result->bindValue(2, $offset, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll();
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
        return self::queryOne('
                        SELECT `user_id`, `name`, `surname`, `email`, `birthday`
                        FROM `users`
                        WHERE `user_id` = ?
                ', array($user_id));
    }

}