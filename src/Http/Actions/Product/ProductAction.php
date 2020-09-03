<?php

namespace ProductsApi\Http\Actions\Category;

use ProductsApi\Http\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use ProductsApi\Domain\Product\IProductRepository;

abstract class ProductAction extends Action
{
    protected $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
}
