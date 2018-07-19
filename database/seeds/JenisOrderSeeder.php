<?php

use Illuminate\Database\Seeder;

class JenisOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\JenisOrder::class,5)->create();
    }
}
