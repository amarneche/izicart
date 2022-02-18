<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('coupon_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_5999525')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id', 'coupon_id_fk_5999525')->references('id')->on('coupons')->onDelete('cascade');
        });
    }
}
