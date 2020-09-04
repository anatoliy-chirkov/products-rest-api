<?php

namespace ProductsApi\Http\Actions\Product;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateProductAction extends ProductAction
{
    protected function action(): Response
    {
        $product = $this->productRepository->update(
            $this->resolveArg('id'),
            $this->getFormData()
        );

        return $this->respond($product);
    }
}
