<?php

namespace ProductsApi\Http\Actions\Product;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteProductAction extends ProductAction
{
    protected function action(): Response
    {
        $this->productRepository->delete([]);

        return $this->respond(null, 204);
    }
}
