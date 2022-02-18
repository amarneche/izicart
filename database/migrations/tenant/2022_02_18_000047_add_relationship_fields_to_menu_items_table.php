<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMenuItemsTable extends Migration
{
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->foreign('menu_id', 'menu_fk_6005982')->references('id')->on('menus');
            $table->unsignedBigInteger('page_id')->nullable();
            $table->foreign('page_id', 'page_fk_6005984')->references('id')->on('pages');
        });
    }
}
