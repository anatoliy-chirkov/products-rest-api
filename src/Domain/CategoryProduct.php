<?php

namespace ProductsApi\Domain;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $categroy_id
 * @property int $product_id
 */
class CategoryProduct extends Model
{
    protected $fillable = ['category_id', 'product_id'];
    protected $hidden = ['created_at', 'updated_at'];
}
