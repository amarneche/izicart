<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_title');
            $table->decimal('price', 15, 2);
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
