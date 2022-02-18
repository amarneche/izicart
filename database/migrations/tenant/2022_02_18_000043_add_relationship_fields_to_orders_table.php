<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id', 'customer_fk_5999504')->references('id')->on('customers');
            $table->unsignedBigInteger('ship_to_wilaya_id')->nullable();
            $table->foreign('ship_to_wilaya_id', 'ship_to_wilaya_fk_5999505')->references('id')->on('wilayas');
            $table->unsignedBigInteger('shipt_to_commune_id')->nullable();
            $table->foreign('shipt_to_commune_id', 'shipt_to_commune_fk_5999506')->references('id')->on('communes');
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_5999538')->references('id')->on('payment_methods');
        });
    }
}
