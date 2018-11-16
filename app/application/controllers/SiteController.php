<?php

namespace application\controllers;

use core\lib\Controller;
use core\lib\Container;

class SiteController extends Controller
{
    protected $getUsersRepository;

    public function __construct()
    {
        $this->openAccessActions = ['error', 'imprint'];

        $this->getUsersRepository = Container::get("GetUsersRepository");
        
        parent::__construct();
    }

    public function error()
    {
        $this->render('site/error');
    }

    public function imprint()
    {
        $this->render('site/imprint', ["author" => $this->getUsersRepository->getOne(1)]);
    }
}