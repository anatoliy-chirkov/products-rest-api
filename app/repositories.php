<?php

use ProductsApi\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;
use ProductsApi\Domain\Category\{ICategoryRepository, CategoryRepository};
use ProductsApi\Domain\Product\{IProductRepository, ProductRepository};

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ICategoryRepository::class => \DI\autowire(CategoryRepository::class),
        IProductRepository::class => \DI\autowire(ProductRepository::class),
    ]);
};
