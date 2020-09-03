<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateProductsTable extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('products', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->float('price')->nullable();
            $table->integer('remnant')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('products');
    }
}
