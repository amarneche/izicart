<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommuneWilayaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('commune_wilaya', function (Blueprint $table) {
            $table->unsignedBigInteger('commune_id');
            $table->foreign('commune_id', 'commune_id_fk_5999112')->references('id')->on('communes')->onDelete('cascade');
            $table->unsignedBigInteger('wilaya_id');
            $table->foreign('wilaya_id', 'wilaya_id_fk_5999112')->references('id')->on('wilayas')->onDelete('cascade');
        });
    }
}
