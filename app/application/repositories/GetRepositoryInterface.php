<?php

namespace application\repositories;

interface GetRepositoryInterface
{
    public function getAll();
    
    public function getOne($id);
}