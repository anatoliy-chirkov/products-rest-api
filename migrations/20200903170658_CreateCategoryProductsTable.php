<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateCategoryProductsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('category_products', function ($table) {
            $table->increments('id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('category_products');
    }
}
