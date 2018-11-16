<?php

namespace core\lib;

use core\lib\Router;
use core\helpers\Request;
use core\helpers\session\FlashMessage;
use core\helpers\session\Auth;

class Controller
{
    protected $openAccessActions = [];

    public function __construct()
    {
        $this->checkAccessbility();
    }

    protected function checkAccessbility()
    {
        if (!in_array(Router::$actionName, $this->openAccessActions) && !Auth::isLogged()) {
            FlashMessage::add('error', 'unthorized to access this page!');
            Request::redirect('/login');
        }
    }

    protected function renderJson(Array $data, String $type = 'application/json')
    {
        header('Content-Type:' . $type);
        echo json_encode($data);
        die();
    }

    protected function render(String $name, Array $data = [])
    {
        if ($data) {
            extract($data);
        }
        require(BASE_PATH . DS . "application" . DS . "views" . DS . $name . ".php");
        die();
    }
}