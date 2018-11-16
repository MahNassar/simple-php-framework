<?php

namespace core\helpers;

class Request implements HelperInterface
{
    public static function redirect($url)
    {
        header("Location: " . SERVER_NAME . $url); // Redirect browser
        exit();
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getHeaders()
    {
        return getallheaders();
    }

    public static function getBodyParams()
    {
        return $_POST;
    }
}