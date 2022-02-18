<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizeAttributePivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_size_attribute', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_5999024')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('size_attribute_id');
            $table->foreign('size_attribute_id', 'size_attribute_id_fk_5999024')->references('id')->on('size_attributes')->onDelete('cascade');
        });
    }
}
