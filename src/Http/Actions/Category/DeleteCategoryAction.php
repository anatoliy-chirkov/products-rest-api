<?php

namespace ProductsApi\Http\Actions\Category;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteCategoryAction extends CategoryAction
{
    protected function action(): Response
    {
        // TODO: add validation
        $this->categoryRepository->delete(
            $this->resolveArg('id'),
            $_GET['delete_children'] ?? true,
            $_GET['delete_products'] ?? true
        );

        return $this->respond(null, 204);
    }
}
