<?php

namespace application\validators;

use core\lib\Model;
use core\lib\traits\ValidatorTrait;
use core\database\ValidatorInterface;

class LoginValidator implements ValidatorInterface
{
    use ValidatorTrait;

    public static function rules()
    {
        return [
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'alphaNum'
            ]
        ];
    } 
}