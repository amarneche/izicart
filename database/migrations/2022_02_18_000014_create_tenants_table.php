<?php

use App\Models\Tenant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            // your custom columns may go here
            $table->string('store_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(0)->nullable();
            $table->datetime('valid_until');
            $table->longText('store_location')->nullable();

      
            $table->json('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down (){
        
        Tenant::all()->each(function($tenant){
            $tenant->delete();
        });
        Schema::dropIfExists('tenants');

        
    }
}
