<?php

namespace ProductsApi\Domain\Product;

use ProductsApi\Domain\Category\NestedIdsScope as CategoryNestedIdsScope;
use ProductsApi\Domain\CategoryProduct;

class ProductRepository implements IProductRepository
{
    public function takeMany(?array $categoriesIds = null, int $minRemnant = 0, int $page = 1, int $perPage = 15)
    {
        $productQuery = Product::query()->select(['products.*'])->with('categories');

        if ($categoriesIds !== null) {
            $categoriesIdsWithNested = [];

            foreach ($categoriesIds as $categoryId) {
                if ($categoryId === null) {
                    $categoriesIdsWithNested[] = null;
                    continue;
                }

                $nestedIdsScope = new CategoryNestedIdsScope($categoryId);
                $categoriesIdsWithNested = array_merge(
                    $categoriesIdsWithNested,
                    $nestedIdsScope->makeWithChildren()
                );
            }

            $productQuery->join('category_products cp', 'products.id', '=', 'cp.product_id');
            $productQuery->whereIn('cp.category_id', $categoriesIdsWithNested);
        }

        $productQuery->where('remnant', '>=', $minRemnant);

        $productsTotal = $productQuery->count();
        $products = $productQuery
            ->limit($perPage)
            ->offset($perPage * ($page - 1))
            ->get()
        ;

        return [
            'items' => $products,
            'total' => $productsTotal,
            'per_page' => $perPage,
            'page' => $page,
            'last_page' => ceil($productsTotal / $perPage),
        ];
    }

    public function create(array $data)
    {
        $product = Product::query()->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'remnant' => $data['remnant'],
        ]);

        foreach ($data['categories_ids'] as $categoryId) {
            CategoryProduct::query()->create([
                'product_id' => $product->id,
                'category_id' => $categoryId,
            ]);
        }

        return array_merge(
            $product->attributesToArray(),
            ['categories' => $product->categories]
        );
    }

    public function update(int $id, array $data)
    {
        $product = Product::query()->find($id);

        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'remnant' => $data['remnant'],
        ]);

        foreach ($product->mappingWithCategories as $productCategory) {
            if (!in_array($productCategory->category_id, $data['categories_ids'])) {
                $productCategory->delete();
            } else {
                $key = array_search($productCategory->category_id, $data['categories_ids']);
                unset($data['categories_ids'][$key]);
            }
        }

        foreach ($data['categories_ids'] as $categoryId) {
            CategoryProduct::query()->create([
                'product_id' => $product->id,
                'category_id' => $categoryId,
            ]);
        }

        return array_merge(
            $product->attributesToArray(),
            ['categories' => $product->categories]
        );
    }

    public function delete(int $id)
    {
        $product = Product::query()->find($id);
        $product->delete();
    }
}
