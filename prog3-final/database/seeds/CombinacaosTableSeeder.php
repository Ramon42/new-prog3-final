<?php

use Illuminate\Database\Seeder;

class CombinacaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Combinacao', 5)->create();
    }
}
