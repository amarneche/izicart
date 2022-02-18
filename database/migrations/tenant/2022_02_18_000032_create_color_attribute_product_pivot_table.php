<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorAttributeProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('color_attribute_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_5999023')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('color_attribute_id');
            $table->foreign('color_attribute_id', 'color_attribute_id_fk_5999023')->references('id')->on('color_attributes')->onDelete('cascade');
        });
    }
}
