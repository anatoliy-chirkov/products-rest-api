<?php

namespace ProductsApi\Domain\Category;

use ProductsApi\Domain\IRepository;

interface ICategoryRepository extends IRepository
{
    public function takeMany(int $page = 1, int $count = 15);
}
