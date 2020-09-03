<?php

namespace ProductsApi\Domain\Category;

use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 * @property int $parent_id
 */
class Category extends Model
{

}
