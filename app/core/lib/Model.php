<?php
namespace core\lib;

use core\database\ValidatorInterface;
use core\database\traits\DbOperationsTrait;
use core\lib\traits\ValidatorTrait;

abstract class Model implements ValidatorInterface
{
    use DbOperationsTrait;
    use ValidatorTrait;

    public static function getTableName()
    {
        return '';
    }
}