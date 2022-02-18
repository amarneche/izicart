<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('coupon_type');
            $table->decimal('value', 15, 2);
            $table->datetime('exipre_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
