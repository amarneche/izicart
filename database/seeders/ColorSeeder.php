<?php

namespace Database\Seeders;

use App\Models\ColorAttribute;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ColorAttribute::create(['value'=>'Red','hex'=>'#000000']);
    }
}
