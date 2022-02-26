<?php

namespace Database\Seeders;

use App\Models\SizeAttribute;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=20; $i<50 ; $i++){
            SizeAttribute::create(['value'=>$i]);
        }
        SizeAttribute::create( ['value'=>'S']);
        SizeAttribute::create( ['value'=>'M']);
        SizeAttribute::create( ['value'=>'L']);
        SizeAttribute::create( ['value'=>'XL']);
        SizeAttribute::create( ['value'=>'XXL']);
        SizeAttribute::create( ['value'=>'XXL']);
        SizeAttribute::create( ['value'=>'4XL']);
        SizeAttribute::create( ['value'=>'5XL']);
    }
}
