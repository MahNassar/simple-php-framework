<?php
namespace application\models;

use core\lib\Model;
use core\helpers\session\Auth;

class Articles extends Model
{

    public static function getTableName()
    {
        return "articles";
    }

    public static function rules()
    {
        return [
            'title' => [
                'required',
                // ['lengthMin', 255]
            ],
            'url' => [
                'url'
            ],
            'content' => [
                'required',
            ],
            'author_id' => [
                'required',
                'integer'
            ],
        ];
    }
}