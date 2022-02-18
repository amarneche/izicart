<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cart_number')->unique();
            $table->decimal('cart_total', 15, 2)->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
