<?php

namespace ProductsApi\Http\Actions\Product;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class CreateProductAction extends ProductAction
{
    protected function action(): Response
    {
        // TODO: add validation; specify passed data, e.g. by class CreateForm
        $product = $this->productRepository->create($this->getFormData());

        return $this->respond($product, 201);
    }
}
