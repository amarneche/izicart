<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryCouponPivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_coupon', function (Blueprint $table) {
            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id', 'coupon_id_fk_5999520')->references('id')->on('coupons')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_5999520')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
