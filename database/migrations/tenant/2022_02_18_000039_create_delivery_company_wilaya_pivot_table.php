<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryCompanyWilayaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_company_wilaya', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_company_id');
            $table->foreign('delivery_company_id', 'delivery_company_id_fk_6022900')->references('id')->on('delivery_companies')->onDelete('cascade');
            $table->unsignedBigInteger('wilaya_id');
            $table->foreign('wilaya_id', 'wilaya_id_fk_6022900')->references('id')->on('wilayas')->onDelete('cascade');
        });
    }
}
