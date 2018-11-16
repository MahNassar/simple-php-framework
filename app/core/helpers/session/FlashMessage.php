<?php

namespace core\helpers\session;

use Exception;
use core\helpers\HelperInterface;

class FlashMessage implements HelperInterface
{
    private static $types = ['success', 'error', 'alert'];

    public static function add($type, $message)
    {
        
        if (!in_array($type, self::$types))
            throw new Exception("Invalid flash message type.", 1);
            
        $_SESSION['flash'][$type] = $message;
    }


    public static function show($type = null)
    {
        $messages = false;
        
        if ($type && isset($_SESSION['flash'][$type])) {
            $messages = $_SESSION['flash'][$type];
            unset($_SESSION['flash'][$type]);
        }

        else if (isset($_SESSION['flash'])) {
            $messages = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        return $messages;
    }
}