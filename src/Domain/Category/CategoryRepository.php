<?php

namespace ProductsApi\Domain\Category;

use ProductsApi\Domain\CategoryProduct;

class CategoryRepository implements ICategoryRepository
{
    public function takeMany(?int $parentId = null, ?bool $visible = null, int $productsMinRemnant = 0, int $page = 1, int $perPage = 15)
    {
        $categoryQuery = Category::query()->withCount('children');

        if ($parentId !== null) {
            $categoryQuery->where('parent_id', $parentId);
        }

        if ($visible !== null) {
            $categoryQuery->where('visible', $visible);
        }

        if ($productsMinRemnant > 0) {
            $categoriesIdsForProductsMinRemnant = [];

            $categoryProductsMapping = CategoryProduct::query()
                ->select(['category_products.*'])
                ->distinct('category_products.category_id')
                ->join('products', 'category_products.product_id', '=', 'products.id')
                ->where('products.remnant', '>=', $productsMinRemnant)
                ->get()
            ;

            foreach ($categoryProductsMapping as $categoryProduct) {
                $nestedIdsScope = new NestedIdsScope($categoryId);
                $categoriesIdsForProductsMinRemnant = array_merge(
                    $categoriesIdsForProductsMinRemnant,
                    $nestedIdsScope->makeWithParents()
                );
            }

            $categoryQuery->whereIn('id', $categoriesIdsForProductsMinRemnant);
        }

        $categoriesTotal = $categoryQuery->count();
        $categories = $categoryQuery
            ->limit($perPage)
            ->offset($perPage * ($page - 1))
            ->get()
        ;

        return [
            'items' => $categories,
            'total' => $categoriesTotal,
            'per_page' => $perPage,
            'page' => $page,
            'last_page' => ceil($categoriesTotal / $perPage),
        ];
    }

    public function create(array $data)
    {
        $category = Category::query()->create([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'] ?? null,
            'visible' => $data['visible'] ?? true,
        ]);

        return $category;
    }

    public function update(int $id, array $data)
    {
        $category = Category::query()->find($id)->update([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
            'visible' => $data['visible'],
        ]);

        return $category;
    }

    public function delete(int $id, bool $deleteChildren = true, bool $deleteProducts = true)
    {
        $category = Category::query()->find($id);

        if ($deleteProducts) {
            $category->products->delete();
        }

        if ($deleteChildren) {
            $nestedIdsScope = new NestedIdsScope($id);
            $categoryWithChildren = Category::query()
                ->whereIn('id', $nestedIdsScope->makeWithChildren())
                ->get()
            ;

            if ($deleteProducts) {
                foreach ($categoryWithChildren as $category) {
                    $category->products->delete();
                }
            }

            $categoryWithChildren->delete();
        } else {
            $category->delete();
        }
    }
}
