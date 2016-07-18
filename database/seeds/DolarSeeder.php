<?php

use Illuminate\Database\Seeder;
use App\DolarValor;
class DolarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DolarValor::create(['valor'=>1200]);
    }
}
