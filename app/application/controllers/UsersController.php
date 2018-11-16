<?php

namespace application\controllers;

use core\lib\Controller;
use core\helpers\Request;
use core\helpers\session\Auth;
use core\lib\Container;
use core\helpers\session\FlashMessage;

class UsersController extends Controller
{
    protected $loginRepository;

    public function __construct()
    {
        $this->openAccessActions = ['error', 'imprint'];
        $this->loginRepository = Container::get("LoginRepository");
    }

    /**
     * login action
     * */
    public function login()
    {
        if (Auth::isLogged()) {
            FlashMessage::add('error', 'You are already logged!');
            Request::redirect('/articles');
        }

        if (Request::method() == 'POST') {
            $params = Request::getBodyParams();

            if (!$this->loginRepository->login($params)){
                FlashMessage::add('error', $this->loginRepository->getLoginError());
                Request::redirect('/login'); 
            }
            
            Request::redirect('/articles'); 
        }

        $this->render('users/login');
    }

    public function logout()
    {
        Auth::logout();
        FlashMessage::add('success', 'logged out;');
        Request::redirect('/articles');
    }
}