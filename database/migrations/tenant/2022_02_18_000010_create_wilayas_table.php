<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayasTable extends Migration
{
    public function up()
    {
        Schema::create('wilayas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wilaya')->unique();
            $table->string('wilaya_ar')->nullable();
            $table->boolean('is_available')->default(0);
            $table->string('default_cost')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
