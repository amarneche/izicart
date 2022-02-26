<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->decimal('price', 15, 2);
            $table->decimal('sale_price', 15, 2)->nullable();
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->string('status')->default(Product::STATUS_SELECT['draft']);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
