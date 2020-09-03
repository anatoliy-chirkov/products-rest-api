<?php

namespace ProductsApi\Http\Actions\Category;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class TakeManyCategoriesAction extends CategoryAction
{
    protected function action(): Response
    {
        $categories = $this->categoryRepository->takeMany();

        return $this->respond($categories);
    }
}
