<?php
namespace application\repositories\articles;

use application\repositories\CreateRepositoryInterface;
use application\models\Articles;
use core\helpers\session\Auth;

class CreateArticlesRepository implements CreateRepositoryInterface
{
    protected $validationErrors = [];
    
    public function create(Array $params)
    {
        $params['author_id'] = Auth::user()['id'];
        if ($this->validationErrors = Articles::getValidationErrors($params)) {
            return false;
        }

        return Articles::insert($params);
    }

    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
}