<?php

$rootUrl = $_SERVER["HTTP_HOST"] . "/";

define("ROOT_URL", $rootUrl);
define("SERVER_NAME", "http://" . $_SERVER['SERVER_NAME']);
define("DS", DIRECTORY_SEPARATOR);
define("BASE_PATH", __DIR__. '/../');
define("CONFIG", __DIR__. '/../config/web.php');
define("VIEWS", __DIR__. '/../application/views');
define("DEBUG", TRUE);
define("ENV", 'WEB');