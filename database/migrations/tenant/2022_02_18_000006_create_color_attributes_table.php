<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('color_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->string('hex_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
