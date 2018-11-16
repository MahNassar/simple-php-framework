<?php

namespace application\repositories;

interface CreateRepositoryInterface
{
    public function create(Array $params);

    public function getValidationErrors();
}