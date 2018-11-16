<?php
namespace core\database;

use core\database\traits\BuildSqlTrait;

class Insert implements SqlStatamentInterface
{
    use BuildSqlTrait;

    protected $connection;
    protected $tableName;
    protected $fields;
    protected $values;
    protected $statement;

    public function __construct($tableName, $insertedData)
    {
        $connectInstance = Connection::getInstance();
        $this->connection = $connectInstance->getConnection();
        $this->tableName = $tableName;
        $this->fields = implode(',', array_keys($insertedData));
        $this->insertedData = $insertedData;
    }

    /**
     * run the statment
     * @return Boolean
     * */
    public function run()
    {
        $statement = $this->connection->prepare($this->getStatmentSql());
        
        if ($this->insertedData) {
            foreach ($this->insertedData as $fieldName => $fieldValue) {
                $statement->bindValue(':' . $fieldName, $fieldValue);
            }
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
        $sql = 'INSERT INTO ' . $this->tableName . '(' . $this->fields . ') ' . ' VALUES(' . $this->getValuesSql() . ')';

        return $sql;
    }

    /**
     * get date values sql string
     * @return String $sql
     **/
    protected function getValuesSql()
    {
        $sql = '';
        $valuesIndex = 1;

        foreach ($this->insertedData as $fieldName => $fieldValue) {
            $sql .= ':' . $fieldName;
            if (count($this->insertedData) > $valuesIndex)
                $sql .= ', ';
            $valuesIndex++;
        }

        return $sql;
    }
}
