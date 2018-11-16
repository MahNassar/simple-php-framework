<?php
namespace application\models;

use core\lib\Model;

class Comments extends Model
{

    public static function getTableName()
    {
        return "articles";
    }

    public static function rules()
    {
        return [
            'article_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'required',
                'alphaNum',
            ],
            'email' => [
                'email'
            ],
            'text' => [
                'required',
                'alphaNum',
            ],
        ];
    } 
}