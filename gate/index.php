<?php

define('ROOT_PATH', __DIR__.'/../');
define('APP_PATH', ROOT_PATH.'/app/');

require ROOT_PATH.'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use ProductsApi\Application;

Application::init()
    ->setupDotEnv()
    ->setupDatabase()
    ->setupHttpRequest()
    ->setupHttpErrorHandler()
    ->setupHttpRoutes()
    ->run()
;
