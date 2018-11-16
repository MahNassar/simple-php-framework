<?php

namespace core\database\traits;

use core\database\Query;
use core\database\Insert;

trait DbOperationsTrait
{
    /**
     * select all query
     * @param Array $params = [
                        'select' => '*',
                        'where' => [],
                        'join' => [['table_name' => '', 'on' => '']],
                        'left join' => [['table_name' => '', 'on' => '']],
                        'group' => [],
                        'order' => [],
                        'limit' => false,
                        'offset' => false
                    ]
     * */
    public static function find(Array $params)
    {
        $query = new Query(static::getTableName(), $params);
        
        return $query->run();
    }

    /**
     * select one query limit by 1
     * @param Array $params = [
                        'select' => '*',
                        'where' => [],
                        'join' => [['table_name' => '', 'on' => '']],
                        'left join' => [['table_name' => '', 'on' => '']],
                        'group' => [],
                    ]
     * */
    public static function findOne(Array $params)
    {
        $params['limit'] = 1;
        
        $query = new Query(static::getTableName(), $params);
        
        $result = $query->run();
        
        return $result ? $result[0] : false;
    }

    public function insert(Array $data)
    {
        $insert = new Insert(static::getTableName(), $data);
        
        return $insert->run();

    }
}