<?php
namespace application\repositories\articles;

use application\repositories\UpdateRepositoryInterface;
use application\models\Articles;

class UpdateArticlesRepository implements UpdateRepositoryInterface
{
	/**
	 * update article
	 * @param Array $model
	 * @param Array $params
	 * @return boolean
	 * */
    public function update(Array $model, Array $params)
    {
        $updatedParams = $this->grapUpdateParams($model, $params);
        
        if ($this->validationErrors = Articles::getValidationErrors($updatedParams)) {
            return false;
        }

        return Articles::update($updatedParams, ["id" => $model['id']]);
    }

    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    /**
     * grap only needed params and skip others for security considrations
     * @param Array $params input params
     * */
    private function grapUpdateParams($model, Array $params)
    {
        $updatedParams = [];
        $updatedParams['title'] = $params['title'];
        $updatedParams['content'] = $params['content'];
        $updatedParams['author_id'] = $model['author_id'];

        return $updatedParams;
    }
}
