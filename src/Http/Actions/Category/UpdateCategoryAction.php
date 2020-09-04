<?php

namespace ProductsApi\Http\Actions\Category;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateCategoryAction extends CategoryAction
{
    protected function action(): Response
    {
        $category = $this->categoryRepository->update(
            $this->resolveArg('id'),
            $this->getFormData()
        );

        return $this->respond($category);
    }
}
