<?php

namespace core\lib;

use Exception;
use ReflectionClass;

class Container
{
    private static $dependancies;

    public static function get(String $key, Array $arguments = [])
    {
        if (isset(self::$dependancies[$key])) {
            
            $arguments = $arguments ? $arguments : self::$dependancies[$key]['arguments'];
            
            switch (self::$dependancies[$key]['type']) {
                
                case "value":
                
                    return self::$dependancies[$key]['value'];
                
                break;
                
                case "class":

                    $obj = (new ReflectionClass(self::$dependancies[$key]['value']));

                    return $obj->newInstanceArgs($arguments);
                
                break;
                
                case "classSingleton":
                    if(self::$map->$key->instance === null) {
                        
                        $obj = (new ReflectionClass(self::$dependancies[$key]['value']));
                        
                        self::$dependancies[$key]['instance'] = $obj->newInstanceArgs($arguments);
                    }
                    
                    return self::$dependancies[$key]['instance'];
                
                break;
            }
        }
        
    }

    public static function mapValue(String $key, $value)
    {
        self::addToMap($key, [
            "value" => $value,
            "type" => "value"
        ]);
    }
    public static function mapClass(String $key, $value, Array $arguments = [])
    {
        self::addToMap($key, [
            "value" => $value,
            "type" => "class",
            "arguments" => $arguments
        ]);
    }
    public static function mapClassAsSingleton(String $key, $value, Array $arguments = [])
    {
        self::addToMap($key, [
            "value" => $value,
            "type" => "classSingleton",
            "instance" => null,
            "arguments" => $arguments
        ]);
    }
    private static function addToMap(String $key, Array $injectedObj)
    {
        if(self::$dependancies === null) {
            self::$dependancies = [];
        }
        self::$dependancies[$key] = $injectedObj;
    }

}

?>