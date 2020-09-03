<?php

namespace ProductsApi\Http\Actions\Category;

use ProductsApi\Http\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use ProductsApi\Domain\Category\ICategoryRepository;

abstract class CategoryAction extends Action
{
    protected $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
}
