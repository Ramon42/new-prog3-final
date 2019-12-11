<?php

use Illuminate\Database\Seeder;

class MensagemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Mensagem', 50)->create();
    }
}
