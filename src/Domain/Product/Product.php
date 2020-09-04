<?php

namespace ProductsApi\Domain\Product;

use Illuminate\Database\Eloquent\Model;
use ProductsApi\Domain\CategoryProduct;
use ProductsApi\Domain\Category\Category;

/**
 * @property-read int $id
 * @property string $name
 * @property float $price
 * @property integer $remnant
 * @property-read Collection $mappingWithCategories
 * @property-read Collection $categories
 */
class Product extends Model
{
    protected $fillable = ['name', 'price', 'remnant'];
    protected $hidden = ['created_at', 'updated_at'];

    public function mappingWithCategories()
    {
        return $this->hasMany(CategoryProduct::class);
    }

    public function categories()
    {
        return $this->hasManyThrough(
            Category::class,
            CategoryProduct::class,
            'product_id',
            'id',
            'id',
            'category_id'
        );
    }
}
