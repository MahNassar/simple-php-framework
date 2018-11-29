<?php
namespace core\database;

use Exception;
use core\database\traits\BuildSqlTrait;

class Update implements SqlStatamentInterface
{
    use BuildSqlTrait;

    protected $connection;
    protected $tableName;
    protected $where;
    protected $updatedData;

    public function __construct($tableName, $updatedData, $where)
    {
        $connectInstance = Connection::getInstance();
        $this->connection = $connectInstance->getConnection();
        $this->tableName = $tableName;
        $this->updatedData = $updatedData;
        $this->where = $where;
    }

    /**
     * run the update statment
     * @return Boolean
     * */
    public function run()
    {
        $statement = $this->connection->prepare($this->getStatmentSql());

        foreach ($this->updatedData as $fieldName => $fieldValue) {
            $statement->bindValue(':' . $fieldName, $fieldValue);
        }

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
        $sql = 'UPDATE ' . $this->tableName . ' SET ' . $this->getUpdateValuesSql();
        if (!isset($this->where) || !$this->where)
            throw new Exception("no where condition passed!", 1);
            
            $sql .= $this->getWhereConnditionSql($this->where);
        
        return $sql;
    }

    /**
     * get updated values sql string
     * @return String $sql
     **/
    protected function getUpdateValuesSql()
    {
        $sql = '';
        $valuesIndex = 1;

        if (!$this->updatedData)
            throw new Exception("no update data passed!", 1);

        foreach ($this->updatedData as $fieldName => $fieldValue) {
            $sql .= $fieldName . ' = :' . $fieldName;
            if (count($this->updatedData) > $valuesIndex)
                $sql .= ', ';
            $valuesIndex++;
        }

        return $sql;
    }
}
