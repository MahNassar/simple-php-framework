<?php
namespace core\database;

use PDO;
use core\database\traits\BuildSqlTrait;

class Query implements SqlStatamentInterface
{
    use BuildSqlTrait;

    protected $connection;
    protected $tableName;
    protected $params;
    protected $statement;

    /**
     *  @param String $tableName
     *  @param Array $params = [
                                'select' => '*',
                                'where' => [],
                                'join' => [['table_name' => '', 'on' => '']],
                                'left join' => [['table_name' => '', 'on' => '']],
                                'group' => [],
                                'order' => [],
                                'limit' => false,
                                'offset' => false
                            ]
     **/
    public function __construct(String $tableName, Array $params)
    {
        $connectInstance = Connection::getInstance();
        $this->connection = $connectInstance->getConnection();
        $this->tableName = $tableName;
        $this->params = $params;
    }

    /**
     * run the query and get the result
     * @return Array $result/ False
     * */
    public function run()
    {
        $this->statement = $this->connection->prepare($this->getStatmentSql());

        $this->bindStatmentParams();

        $result = $this->statement->execute();
        
        if ($result) {
            return $this->statement->fetchAll();
        }

        return false;
    }

    /**
     * bind sql statment params
     **/
    protected function bindStatmentParams()
    {
        if (!$this->statement)
            throw new Exception("no statment initialized !", 1);
            
        if (isset($this->params['where']) && $this->params['where']) {
           foreach ($this->params['where'] as $fieldName => $fieldValue) {
               $this->statement->bindValue(':' . preg_replace("/[^A-Za-z0-9 ]/", '', $fieldName), $fieldValue);
           }
        }

        if (isset($this->params['order']) && $this->params['order']) {
           foreach ($this->params['order'] as $orderByIndex => $fieldName) {
               $this->statement->bindValue(':' . preg_replace("/\s+/", '', $fieldName),  $fieldName);
           }
        }

        if (isset($this->params['limit']) && $this->params['limit']) {
            $this->statement->bindValue(':limit', $this->params['limit'], PDO::PARAM_INT);
        }

        if (isset($this->params['offset']) && $this->params['offset']) {
            $this->statement->bindValue(':offset', $this->params['offset'], PDO::PARAM_INT);
        }
    }


    /**
     * get statment sql string
     * @return String $sql
     * */
    public function getStatmentSql()
    {
        $sql = 'SELECT '; 
        

        if (isset($this->params['select']) && $this->params['select'] && is_array($this->params['select'])) {
            $sql .= $this->getSelectSql($this->params['select']);
        } else {
            $sql .= '*';
        }
        
        $sql .= ' FROM ' . $this->tableName;
        

        if (isset($this->params['left join']) && $this->params['left join']) {
            $sql .= $this->getLeftJoinSql($this->params['left join']);
        }

        if (isset($this->params['where']) && $this->params['where']) {
            $sql .= $this->getWhereConnditionSql($this->params['where']);
        }

        if (isset($this->params['group']) && $this->params['group']) {
            $sql .= $this->getGroupBy($this->params['group']);
        }

        if (isset($this->params['order']) && $this->params['order']) {
            $sql .= $this->getOrderSql($this->params['order']);
        }

        if (isset($this->params['limit']) && $this->params['limit']){
            $sql .= $this->getLimitSql();
        }

        if (isset($this->params['offset']) && $this->params['offset']){
            $sql .= $this->getLimitSql();
        }

        return $sql;
    }
}
