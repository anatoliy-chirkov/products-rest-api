<?php

define('ROOT_PATH', __DIR__.'/../');

use Phpmig\Adapter;
use ProductsApi\Application;

$app = Application::init()
    ->setupDotEnv()
    ->setupDatabase()
;

$container = new ArrayObject;
$container['phpmig.adapter'] = new Adapter\Illuminate\Database(
    $app->getDatabaseObject(),
    'migrations'
);
$container['phpmig.migrations_path'] = ROOT_PATH.'migrations';

return $container;
