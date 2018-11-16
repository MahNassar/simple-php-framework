<?php

namespace core\helpers\session;

use Exception;
use core\helpers\HelperInterface;

class Auth implements HelperInterface
{

    public static function login($user)
    {
        if (!$user)
            return false;

        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['name'] = $user['name'];
        $_SESSION['user']['email'] = $user['email'];

        return true;
    }

    public static function logout()
    {
        if (isset($_SESSION['user']))
            unset($_SESSION['user']);
    }

    public static function isLogged()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user'])
            return false;

        return true;
    }

    public static function user()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user'])
            return false;

        return $_SESSION['user'];
    }
}