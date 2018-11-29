<?php

namespace application\controllers;

use Exception;
use core\lib\Container;
use core\lib\Controller;
use application\models\Articles;
use core\helpers\Request;
use core\helpers\session\FlashMessage;
use core\helpers\session\Auth;

class ArticlesController extends Controller
{
    protected $getArticlesRepository;
    protected $createArticlesRepository;
    protected $updateArticlesRepository;

    public function __construct()
    {
        $this->openAccessActions = ['index', 'view'];
        $this->getArticlesRepository = Container::get("GetArticlesRepository");
        $this->createArticlesRepository = Container::get("CreateArticlesRepository");
        $this->updateArticlesRepository = Container::get("UpdateArticlesRepository");
        
        parent::__construct();
    }

    public function index()
    {
        $models = $this->getArticlesRepository->getAll();
        
        $this->render('articles/index', ['models' => $models]);
    }

    public function view(int $id)
    {
        $model = $this->getArticlesRepository->getOne($id);
        
        if (!$model)
            Request::redirect('/error');

        $this->render('articles/view', ['model' => $model]);
    }

    public function create()
    {
        if (Request::method() == 'POST') {
            $params = Request::getBodyParams();

            if ($this->createArticlesRepository->create($params)) {
                FlashMessage::add('success', 'data saved !');
            } else {
                FlashMessage::add('error', 'can not create the article <br>' . json_encode($this->createArticlesRepository->getValidationErrors()));
            }
        }

        $this->render('articles/form');
    }

    /**
     * update action
     * @param int $id of article
     * */
    public function update(int $id)
    {
        $model = $this->getArticlesRepository->getOne($id);
        
        if (!$model){
            Request::redirect('/error');
        } else if($model['author_id'] != Auth::user()['id']) {
           FlashMessage::add('error', 'you are not authorized to update this article !');
           Request::redirect('/articles'); 
        }

        if (Request::method() == 'POST') {
            $params = Request::getBodyParams();

            if ($this->updateArticlesRepository->update($model, $params)) {
                FlashMessage::add('success', 'data saved !');
                Request::redirect('/articles');
            } else {
                FlashMessage::add('error', 'can not update the article <br>' . json_encode($this->updateArticlesRepository->getValidationErrors()));
                Request::redirect('/articles');
            }
        }

        $this->render('articles/form', ['model' => $model]);
    }

    public function delete($id)
    {

    }
}