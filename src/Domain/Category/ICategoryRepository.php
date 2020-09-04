<?php

namespace ProductsApi\Domain\Category;

use ProductsApi\Domain\ICreateUpdateRepository;

interface ICategoryRepository extends ICreateUpdateRepository
{
    public function takeMany(?int $parentId = null, ?bool $visible = null, int $productsMinRemnant = 0, int $page = 1, int $perPage = 15);
    public function delete(int $id, bool $deleteChildren = true, bool $deleteProducts = true);
}
