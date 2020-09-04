<?php

namespace ProductsApi\Http\Actions\Category;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class TakeManyCategoriesAction extends CategoryAction
{
    private const DEFAULT_RESULTS_PER_PAGE = 15;

    protected function action(): Response
    {
        $categories = $this->categoryRepository->takeMany(
            $_GET['parent_id'] ?? null,
            $_GET['visible'] ?? null,
            $_GET['products_min_remnant'] ?? 0,
            $_GET['page'] ?? 1,
            $_GET['per_page'] ?? self::DEFAULT_RESULTS_PER_PAGE
        );

        return $this->respond($categories);
    }
}
