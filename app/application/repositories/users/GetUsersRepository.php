<?php

namespace application\repositories\users;

use application\repositories\GetRepositoryInterface;
use application\models\Users;

class GetUsersRepository implements GetRepositoryInterface
{
    public function getAll()
    {
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 50;
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id DESC';
        
        $models = Users::find(['limit' => $limit, 'offset'=> $offset, 'order' => [$order]]);

        return $models;
    }

    public function getOne($id)
    {
        $model = Users::findOne(["where" => ["id" => $id]]);

        return $model;
    }

    public function getUserByEmail($email)
    {
        $model = Users::findOne(["where" => ["email" => $email]]);

        return $model;
    }
}