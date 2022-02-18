<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunesTable extends Migration
{
    public function up()
    {
        Schema::create('communes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('commune');
            $table->string('commune_ar')->nullable();
            $table->boolean('is_available')->default(0);
            $table->decimal('delivery_cost', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
