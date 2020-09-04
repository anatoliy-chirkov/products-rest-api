<?php

namespace ProductsApi\Http\Actions\Category;

use ProductsApi\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class CreateCategoryAction extends CategoryAction
{
    protected function action(): Response
    {
        // TODO: add validation; specify passed data, e.g. by class CreateForm
        $category = $this->categoryRepository->create($this->getFormData());

        return $this->respond($category, 201);
    }
}
