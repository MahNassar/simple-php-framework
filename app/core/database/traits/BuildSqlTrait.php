<?php

namespace core\database\traits;

use Exception;

trait BuildSqlTrait
{

    /**
     * @return String $sql
     **/
    public function getSelectSql($selectArr)
    {
        $sql = '';
        $selectIndex = 1;

        foreach ($selectArr as $fieldName) {
            $sql .= $fieldName;
            if (count($selectArr) > $selectIndex)
                $sql .= ', ';
            $selectIndex++;
        }

        return $sql;
    }

    /**
     * @return String $sql
     **/
    public function getWhereConnditionSql($whereArr)
    {
        $sql = ' WHERE ';
        $whereIndex = 1;

        foreach ($whereArr as $fieldName => $fieldValue) {
            $sql .= $fieldName . ' = :' . preg_replace("/[^A-Za-z0-9 ]/", '', $fieldName);
            if (count($whereArr) > $whereIndex)
                $sql .= ' AND ';
            $whereIndex++;
        }

        return $sql;
    }

    /**
     * @return String $sql
     **/
    public function getLeftJoinSql($leftJoinArr)
    {
        $sql = '';

        foreach ($leftJoinArr as $childLeftJoin) {
            if (!isset($childLeftJoin['table_name']) || !isset($childLeftJoin['on']))
                throw new Exception("invalid left join params!", 1);
                
            $sql .= ' LEFT JOIN ' . $childLeftJoin['table_name'] . ' ON ' . $childLeftJoin['on'];
        }

        return $sql;
    }

    /**
     * @return String $sql
     **/
    public function getGroupBy($groupByArr)
    {
        $sql = ' GROUP BY ';
        $groupByIndex = 1;

        foreach ($groupByArr as $fieldName) {
            $sql .= $fieldName;

            if (count($groupByArr) > $groupByIndex)
                $sql .= ', ';
            $groupByIndex++;
        }

        return $sql;
    }

    /**
     * @return String $sql
     **/
    public static function getOrderSql($orderArray)
    {
        $sql = ' ORDER BY ';
        $orderByIndex = 1;

        foreach ($orderArray as $fieldName) {
            $sql .= ':' . preg_replace("/\s+/", '', $fieldName);
            
            if (count($orderArray) > $orderByIndex)
                $sql .= ', ';
            $orderByIndex++;
        }

        return $sql;
    }

    /**
     * @return String $sql
     **/
    public static function getLimitSql()
    {
        $sql = ' LIMIT :limit';

        return $sql;
    }

    /**
     * @return String $sql
     **/
    public static function getLimitOffset()
    {
        $sql = ' OFFSET :offset';

        return $sql;
    }
}