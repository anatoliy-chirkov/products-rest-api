<?php

namespace ProductsApi\Domain\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 * @property float $price
 * @property integer $remnant
 */
class Product extends Model
{

}
