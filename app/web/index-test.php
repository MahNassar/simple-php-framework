<?php

if (!session_id())
    session_start();

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../config/container_dependancies.php";
require __DIR__ . "/../config/env_test.php";
require __DIR__ . "/../config/test.php";