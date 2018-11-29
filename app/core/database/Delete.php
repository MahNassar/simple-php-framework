<?php
namespace core\database;

use Exception;
use core\database\traits\BuildSqlTrait;

class Delete implements SqlStatamentInterface
{
    use BuildSqlTrait;

    protected $connection;
    protected $tableName;
    protected $where;

    public function __construct($tableName, $where)
    {
        $connectInstance = Connection::getInstance();
        $this->connection = $connectInstance->getConnection();
        $this->tableName = $tableName;
        $this->where = $where;
    }

    /**
     * run the delete statment
     * @return Boolean
     * */
    public function run()
    {
        $statement = $this->connection->prepare($this->getStatmentSql());


        foreach ($this->where as $fieldName => $fieldValue) {
            $statement->bindValue(':' . $fieldName, $fieldValue);
        }

        $result = $statement->execute();
        
        if ($result) {
            return true;
        }

        return false;
    }

    /**
     * get statment sql string
     * @return String $sql
     * */
    public function getStatmentSql()
    {
        $sql = 'DELETE FROM ' . $this->tableName;
        if (!isset($this->where) || !$this->where)
            throw new Exception("no where condition passed!", 1);

            $sql .= $this->getWhereConnditionSql($this->where);
        
        return $sql;
    }

}
