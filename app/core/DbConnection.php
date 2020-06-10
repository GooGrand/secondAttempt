<?php


class DbConnection
{
    private static $instance = null;
    private $connection;


    // The db connection is established in the private constructor.
    private function __construct($dbConf = 'config.php')
    {
        $this->connnection = new PDO('mysql:host=' .$dbConf['host']. ';dbname=' . $dbConf['name'],
            $dbConf['user'],
            $dbConf['pass'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}