<?php

namespace ProductsApi\Http\Actions\Product;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateProductAction extends ProductAction
{
    protected function action(): Response
    {
        // TODO: add validation; specify passed data, e.g. by class UpdateForm
        $product = $this->productRepository->update(
            $this->resolveArg('id'),
            $this->getFormData()
        );

        return $this->respond($product);
    }
}
