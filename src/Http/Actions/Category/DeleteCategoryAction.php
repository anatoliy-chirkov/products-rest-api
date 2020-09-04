<?php

namespace ProductsApi\Http\Actions\Category;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteCategoryAction extends CategoryAction
{
    protected function action(): Response
    {
        $this->categoryRepository->delete(
            $this->resolveArg('id'),
            $_GET['delet_children'],
            $_GET['delete_products']
        );

        return $this->respond(null, 204);
    }
}
