<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodWilayaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('payment_method_wilaya', function (Blueprint $table) {
            $table->unsignedBigInteger('wilaya_id');
            $table->foreign('wilaya_id', 'wilaya_id_fk_5999483')->references('id')->on('wilayas')->onDelete('cascade');
            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id', 'payment_method_id_fk_5999483')->references('id')->on('payment_methods')->onDelete('cascade');
        });
    }
}
