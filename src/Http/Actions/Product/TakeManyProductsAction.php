<?php

namespace ProductsApi\Http\Actions\Product;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class TakeManyProductsAction extends ProductAction
{
    protected function action(): Response
    {
        $products = $this->productRepository->takeMany();

        return $this->respond($products);
    }
}
