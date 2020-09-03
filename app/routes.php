<?php

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use ProductsApi\Http\Actions\Category\TakeManyCategoriesAction;
use ProductsApi\Http\Actions\Category\CreateCategoryAction;
use ProductsApi\Http\Actions\Category\UpdateCategoryAction;
use ProductsApi\Http\Actions\Category\DeleteCategoryAction;

use ProductsApi\Http\Actions\Product\TakeManyProductsAction;
use ProductsApi\Http\Actions\Product\CreateProductAction;
use ProductsApi\Http\Actions\Product\UpdateProductAction;
use ProductsApi\Http\Actions\Product\DeleteProductAction;

return function (App $app) {
    $app->group('/categories', function (Group $group) {
        $group->get('', TakeManyCategoriesAction::class);
        $group->post('', CreateCategoryAction::class);
        $group->put('/{id:[0-9]+}', UpdateCategoryAction::class);
        $group->delete('/{id:[0-9]+}', DeleteCategoryAction::class);
    });

    $app->group('/products', function (Group $group) {
        $group->get('', TakeManyProductsAction::class);
        $group->post('', CreateProductAction::class);
        $group->put('/{id:[0-9]+}', UpdateProductAction::class);
        $group->delete('/{id:[0-9]+}', DeleteProductAction::class);
    });
};
