<?php

namespace ProductsApi\Domain\Product;

class ProductRepository implements IProductRepository
{
    public function takeMany(int $categoryId = null, int $page = 1, int $count = 15)
    {
        $productQuery = Product::query();

        // if ($categoryId !== null) {
        //     $productQuery->join('category_products cp', 'products.id', '=', 'cp.product_id');
        //     $productQuery->where('category_id', $categoryId);
        // }

        return $productQuery->paginate($count);
    }

    public function create(array $data)
    {
        $product = Product::query()->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'remnant' => $data['remnant'],
        ]);

        return $product;
    }

    public function update(int $id, array $data)
    {
        $product = Product::query()->find($id)->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'remnant' => $data['remnant'],
        ]);

        return $product;
    }

    public function delete(int $id)
    {
        $product = Product::query()->find($id);
        $product->delete();
    }
}
