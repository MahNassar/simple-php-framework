<?php
namespace core\database;

use PDO;
use core\lib\Config;
use Exception;

class Connection
{

    private $connection;
    private static $instance;

    /**
     * Get an instance of the Database
     * and connection
     */
    public static function getInstance()
    {
        if (!self::$instance) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        try {
            $configInstance = Config::getInstance();
            $config = $configInstance->getConfig('db');

            if (!$config)
                throw new Exception("can't find database configration", 1);

            $this->connection = new PDO($config['type'] . ':host='. $config['host'] . ';dbname=' . $config['name'] . ';charset=' . $config['charset'],  
                                        $config['username'], $config['password'], [
                                                PDO::ATTR_EMULATE_PREPARES => false,  
                                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '" . $config['charset'] . "'"
                                            ]);
        } catch (Exception $e) {
          die("Unable to connect: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
