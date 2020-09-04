<?php

namespace ProductsApi\Domain\Category;

class NestedIdsScope
{
    private $currentCategory;

    public function __construct(int $categoryId)
    {
        $this->currentCategory = Category::query()->find($categoryId);
    }

    public function makeWithChildren($nestedIdsScope = [])
    {
        $nestedIdsScope[] = $this->currentCategory->id;

        if (!$this->currentCategory->children->isEmpty()) {
            foreach ($this->currentCategory->children as $child) {
                $this->currentCategory = $child;
                $nestedIdsScope = $this->makeWithChildren($nestedIdsScope);
            }
        }

        return $nestedIdsScope;
    }

    public function makeWithParents($nestedIdsScope = [])
    {
        $nestedIdsScope[] = $this->currentCategory->id;

        if ($this->currentCategory->parent !== null) {
            $this->currentCategory = $this->currentCategory->parent;
            $nestedIdsScope = $this->makeWithParents($nestedIdsScope);
        }

        return $nestedIdsScope;
    }
}
