<?php

namespace application\repositories\articles;

use application\repositories\GetRepositoryInterface;
use application\models\Articles;

class GetArticlesRepository implements GetRepositoryInterface
{
    public function getAll()
    {
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 3;
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $order = isset($_GET['order']) ? $_GET['order'] : 'id DESC';
        
        $models = Articles::find([
                                'select' => [
                                        'articles.id AS id',
                                        'articles.title AS title',
                                        'articles.content AS content',
                                        'articles.url AS image',
                                        'articles.created_at AS created_at',
                                        'articles.author_id AS author_id',
                                        'count(comments.id) AS comments_count',
                                        'users.name AS author_name',
                                    ],
                                'left join' => [
                                                ['table_name' => 'users', 'on' => 'users.id = articles.author_id'],
                                                ['table_name' => 'comments', 'on' => 'comments.article_id = articles.id']
                                            ],
                                'group' => ['articles.id'],
                                'limit' => $limit,
                                'offset'=> $offset,
                                'order' => [$order]
                            ]);
        return $models;
    }

    public function getOne($id)
    {
        $model = Articles::findOne([
                                'select' => [
                                        'articles.id AS id',
                                        'articles.title AS title',
                                        'articles.content AS content',
                                        'articles.url AS image',
                                        'articles.created_at AS created_at',
                                        'articles.author_id AS author_id',
                                        'users.name AS author_name',
                                    ],
                                'left join' => [
                                                ['table_name' => 'users', 'on' => 'users.id = articles.author_id'],
                                            ],
                                "where" => ["articles.id" => $id],
                                'group' => ['articles.id']
                            ]);

        return $model;
    }
}