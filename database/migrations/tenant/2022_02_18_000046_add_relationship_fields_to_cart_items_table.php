<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCartItemsTable extends Migration
{
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('cart_id', 'cart_fk_6005067')->references('id')->on('carts');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_6005068')->references('id')->on('products');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id', 'color_fk_6005071')->references('id')->on('color_attributes');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id', 'size_fk_6005072')->references('id')->on('size_attributes');
            $table->unsignedBigInteger('variation_id')->nullable();
            $table->foreign('variation_id', 'variation_fk_6005073')->references('id')->on('variation_attributes');
        });
    }
}
