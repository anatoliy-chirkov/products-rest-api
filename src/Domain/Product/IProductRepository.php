<?php

namespace ProductsApi\Domain\Product;

use ProductsApi\Domain\ICreateUpdateRepository;

interface IProductRepository extends ICreateUpdateRepository
{
    public function takeMany(?array $categoriesIds = null, int $minRemnant = 0, int $page = 1, int $perPage = 15);
    public function delete(int $id);
}
