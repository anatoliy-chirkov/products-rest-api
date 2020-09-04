<?php

namespace ProductsApi\Http\Actions\Product;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class TakeManyProductsAction extends ProductAction
{
    private const DEFAULT_RESULTS_PER_PAGE = 15;

    protected function action(): Response
    {
        // TODO: add validation
        $products = $this->productRepository->takeMany(
            $_GET['name'] ?? null
            $_GET['categories_ids'] ?? null,
            $_GET['min_remnant'] ?? 0,
            $_GET['page'] ?? 1,
            $_GET['per_page'] ?? self::DEFAULT_RESULTS_PER_PAGE
        );

        return $this->respond($products);
    }
}
