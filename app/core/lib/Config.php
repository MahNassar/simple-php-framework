<?php
namespace core\lib;

use Exception;

class Config
{
    private static $instance;
    private $config;

    /**
     * Get an instance of the Config
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
        $this->config = require CONFIG;
    }

    public function getConfig($name)
    {
        if (!isset($this->config))
            throw new Exception("config is not intialized!", 1);

        if (!isset($this->config[$name]))
            throw new Exception("undefined config!", 1);

        return $this->config[$name];
    }
}
