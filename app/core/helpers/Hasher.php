<?php

namespace core\helpers;

use Exception;
use core\helpers\HelperInterface;

class Hasher implements HelperInterface
{
    public static function hashPasswrod($password)
    {
        return md5($password);
    }
}