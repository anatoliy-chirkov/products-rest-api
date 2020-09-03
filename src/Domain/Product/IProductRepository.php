<?php

namespace ProductsApi\Domain\Product;

use ProductsApi\Domain\IRepository;

interface IProductRepository extends IRepository
{
    public function takeMany(int $categoryId = null, int $page = 1, int $count = 15);
}
