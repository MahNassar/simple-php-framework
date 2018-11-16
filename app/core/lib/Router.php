<?php

namespace core\lib;

use core\helpers\Request;
use Exception;

class Router
{
    protected static $pattern;
    public static $ctrlName;
    public static $actionName;
    protected static $arguments = [];

    /**
     * get the suitabile action for current request pattern
     *  @return Array $routes
     * */
    public static function run(Array $routes)
    {
        $ctrlAction = "";
        self::$pattern = $_SERVER['REQUEST_URI'];

        foreach ($routes as $pattern => $routeAction) {
            $patternAsRegex = self::getRegex($pattern);

            if ($ok = preg_match($patternAsRegex, self::$pattern, $matches)) {
                self::$arguments = array_intersect_key(
                    $matches,
                    array_flip(array_filter(array_keys($matches), 'is_string'))
                );
                $ctrlAction = $routeAction;

                break;
            }
        }
        if (!$ctrlAction)
            self::error404();

        $ctrlActionArr = explode(".", $ctrlAction);
        if (!$ctrlAction)
            throw new Exception("wrong ctrl.action pattern", 1);

        self::$ctrlName = $ctrlActionArr[0];
        self::$actionName = $ctrlActionArr[1];

        self::loadAction();
    }

    /**
     * load action from it's controller and pass arguments to it
     * */
    protected function loadAction()
    {
        $controllerFilePath = BASE_PATH . DS . "application" . DS . "controllers" . DS . self::$ctrlName . ".php";
        
        if (!file_exists($controllerFilePath)) {
            self::error404();
        
        } else {
        
            $ctrlClass = "application\controllers\\" . self::$ctrlName;
            $controller = new $ctrlClass();
            $params = "";
        
            if (self::$arguments) {
                foreach (self::$arguments as $key => $value) {
                    $params .= $value . ",";
                }
            }
        
            $params = rtrim($params, ",");
            $controller->{self::$actionName}($params);
        }
    }

    /**
     * redirect to 404 page
     * */
    protected function error404()
    {
        Request::redirect('/error');
    }

    /**
     * match route pattern
     * */
    protected function getRegex(String $pattern)
    {
        if (preg_match('/[^-:\/_{}()a-zA-Z\d]/', $pattern))
            return false; // Invalid pattern

        // // Turn "(/)" into "/?"
        $pattern = preg_replace('#\(/\)#', '/?', $pattern);

        // // Create capture group for ":parameter"
        $allowedParamChars = '[a-zA-Z0-9\_\-]+';
        $pattern = preg_replace(
            '/:(' . $allowedParamChars . ')/',   # Replace ":parameter"
            '(?<$1>' . $allowedParamChars . ')', # with "(?<parameter>[a-zA-Z0-9\_\-]+)"
            $pattern
        );

        // Create capture group for '{parameter}'
        $pattern = preg_replace(
            '/{(' . $allowedParamChars . ')}/',    # Replace "{parameter}"
            '(?<$1>/' . $allowedParamChars . ')', # with "(?<parameter>[a-zA-Z0-9\_\-]+)"
            $pattern
        );

        // Add start and end matching
        $patternAsRegex = "@^" . $pattern . "$@D";

        return $patternAsRegex;
    }

}
