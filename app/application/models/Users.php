<?php

namespace application\models;

use core\lib\Model;

class Users extends Model
{

    public static function getTableName()
    {
        return "users";
    }

    public static function rules()
    {
        return [
            'name' => [
                'required',
                'alphaNum',
            ],
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'alphaNum'
            ],
        ];
    } 
}