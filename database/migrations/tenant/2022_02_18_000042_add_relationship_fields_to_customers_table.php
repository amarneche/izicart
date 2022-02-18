<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('wilaya_id')->nullable();
            $table->foreign('wilaya_id', 'wilaya_fk_5999491')->references('id')->on('wilayas');
            $table->unsignedBigInteger('commune_id')->nullable();
            $table->foreign('commune_id', 'commune_fk_5999492')->references('id')->on('communes');
        });
    }
}
