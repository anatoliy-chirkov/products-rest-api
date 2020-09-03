<?php

namespace ProductsApi\Domain\Category;

class CategoryRepository implements ICategoryRepository
{
    public function takeMany(int $page = 1, int $count = 15)
    {
        return Category::query()->paginate($count);
    }

    public function create(array $data)
    {
        $category = Category::query()->create([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
        ]);

        return $category;
    }

    public function update(int $id, array $data)
    {
        $category = Category::query()->find($id)->update([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
        ]);

        return $category;
    }

    public function delete(int $id)
    {
        $category = Category::query()->find($id);
        $category->delete();
    }
}
