<?php

$routesArr = [
        "/login" => "UsersController.login",
        "/logout" => "UsersController.logout",
        "/error" => "SiteController.error",
        "/site/imprint" => "SiteController.imprint",
        "/" => "ArticlesController.index",
        "/articles" => "ArticlesController.index",
        "/articles/create" => "ArticlesController.create",
        "/articles/:id" => "ArticlesController.view",
    ];

core\lib\Router::run($routesArr);
