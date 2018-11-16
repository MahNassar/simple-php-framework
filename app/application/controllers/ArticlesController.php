<?php

namespace application\controllers;

use Exception;
use core\lib\Container;
use core\lib\Controller;
use application\models\Articles;
use core\helpers\Request;
use core\helpers\session\FlashMessage;

class ArticlesController extends Controller
{
    protected $getArticlesRepository;
    protected $createArticlesRepository;

    public function __construct()
    {
        $this->openAccessActions = ['index', 'view'];
        $this->getArticlesRepository = Container::get("GetArticlesRepository");
        $this->createArticlesRepository = Container::get("CreateArticlesRepository");
        
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
}