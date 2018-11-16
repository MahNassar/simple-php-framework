<?php

namespace application\repositories\users;

use Exception;
use core\lib\Container;
use application\validators\LoginValidator;
use core\helpers\Hasher;
use core\helpers\session\Auth;

class LoginRepository
{
    protected $loginError;
    protected $getUsersRepository;

    public function __construct()
    {
        $this->getUsersRepository = Container::get("GetUsersRepository");
    }

    public function login(Array $params)
    {
        if ($this->loginError = LoginValidator::getValidationErrors($params)) {
            $this->loginError = "Invalid Login Params!";
            return false;
        }

        $user = $this->getUsersRepository->getUserByEmail($params['email']);
        if (!$user || !$this->comparePasswords($params['password'], $user['password'])){
            $this->loginError = "Invalid user or password!";
            return false; 
        }

        return Auth::login($user);
    }

    protected function comparePasswords($inputPassword, $userPassword)
    {
        return Hasher::hashPasswrod($inputPassword) == $userPassword;
    }

    public function getLoginError()
    {
        return $this->loginError;
    }
}