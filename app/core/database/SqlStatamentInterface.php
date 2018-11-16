<?php

namespace core\database;

interface SqlStatamentInterface
{
    /**
     * run the statment and get the result
     * */
    public function run();

    /**
     * get the statment sql string
     * */
    public function getStatmentSql();
}
