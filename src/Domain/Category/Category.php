<?php

namespace ProductsApi\Domain\Category;

use Illuminate\Database\Eloquent\Model;
use ProductsApi\Domain\CategoryProduct;
use ProductsApi\Domain\Product\Product;

/**
 * @property-read int $id
 * @property string $name
 * @property int $parent_id
 * @property bool $visible
 * @property-read Collection $children
 * @property-read Category $parent
 */
class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'visible'];
    protected $hidden = ['created_at', 'updated_at', 'laravel_through_key'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            CategoryProduct::class,
            'category_id',
            'id',
            'id',
            'product_id'
        );
    }
}
