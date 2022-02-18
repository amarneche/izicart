<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationAttributePivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_variation_attribute', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_5999025')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('variation_attribute_id');
            $table->foreign('variation_attribute_id', 'variation_attribute_id_fk_5999025')->references('id')->on('variation_attributes')->onDelete('cascade');
        });
    }
}
