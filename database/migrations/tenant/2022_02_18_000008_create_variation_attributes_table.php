<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('variation_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->decimal('price', 15, 2);
            $table->decimal('sale_price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
