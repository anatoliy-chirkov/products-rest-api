<?php

namespace ProductsApi\Http\Actions\Product;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class CreateProductAction extends ProductAction
{
    protected function action(): Response
    {
        $product = $this->productRepository->create([]);

        return $this->respond($product, 201);
    }
}
